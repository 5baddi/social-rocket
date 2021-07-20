<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth\Subscription;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Pack;
use BADDIServices\ClnkGO\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\PackService;
use BADDIServices\ClnkGO\Services\SubscriptionService;
use BADDIServices\ClnkGO\Exceptions\Shopify\CreatePaymentConfirmationFailed;

class BillingPaymentController extends Controller
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

    public function __invoke(string $packId)
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            abort_unless($store instanceof Store, Response::HTTP_NOT_FOUND, 'Store not found');
            
            $pack = $this->packService->findById($packId);
            abort_unless($pack instanceof Pack, Response::HTTP_NOT_FOUND, 'No pack selected');

            $confirmationURL = $this->subscriptionService->createBillingConfirmationURL($store, $pack);

            return redirect($confirmationURL);
        } catch(CreatePaymentConfirmationFailed $ex) {
            return redirect()->route('subscription.select.pack')->with('error', $ex->getMessage());
        } catch(Throwable $ex) {
            return redirect()->route('subscription.select.pack')->with('error', 'Internal server error');
        }
    }
}
