<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\AppLogger;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Events\Subscription\SubscriptionActivated as SubscriptionSubscriptionActivated;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\PackService;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use BADDIServices\SocialRocket\Exceptions\Shopify\AcceptPaymentFailed;
use BADDIServices\SocialRocket\Http\Requests\BillingConfirmationRequest;
use BADDIServices\SocialRocket\Notifications\Subscription\SubscriptionActivated;
use BADDIServices\SocialRocket\Exceptions\Shopify\IntegateAppLayoutToThemeFailed;
use Illuminate\Support\Facades\Event;

class BillingConfirmationController extends Controller
{
    /** @var PackService */
    private $packService;
    
    /** @var SubscriptionService */
    private $subscriptionService;

    public function __construct(PackService $packService, SubscriptionService $subscriptionService)
    {
        $this->packService = $packService;
        $this->subscriptionService = $subscriptionService;
    }

    public function __invoke(string $packId, BillingConfirmationRequest $request)
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            abort_unless($store instanceof Store, Response::HTTP_NOT_FOUND, 'Store not found');
            
            $pack = $this->packService->findById($packId);
            abort_unless($pack instanceof Pack, Response::HTTP_NOT_FOUND, 'No pack selected');

            $subscription = $this->subscriptionService->confirmBilling($user, $store, $pack, $request->query('charge_id'));
            if (!$subscription instanceof Subscription || $subscription->status !== Subscription::CHARGE_ACCEPTED) {
                return redirect()->route('subscription.select.pack')
                                ->with(
                                    'alert',
                                    new Alert('Plan not activated please try to accept the billiing')
                                );
            }

            $subscription = $this->subscriptionService->loadRelations($subscription);
            $user->notify(new SubscriptionActivated($subscription));

            Event::dispatch(new SubscriptionSubscriptionActivated($user, $subscription));

            return redirect()->route('dashboard')
                            ->with(
                                'alert',
                                new  Alert(ucwords($pack->name) . ' plan activated successfully', 'success')
                            );
        } catch (AcceptPaymentFailed | IntegateAppLayoutToThemeFailed $e) {
            return redirect()->route('subscription.select.pack')
                            ->with(
                                'alert',
                                new Alert($e->getMessage())
                            ); 
        } catch (Throwable $e) {
            AppLogger::setStore($store ?? null)->error($e, 'store:confirm-billing', ['playload' => $request->all()]);

            return redirect()->route('subscription.select.pack')
                            ->with(
                                'alert',
                                new Alert('Internal server error')
                            ); 
        }
    }
}