<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Models\Pack;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\PackService;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;

class BillingPayController extends Controller
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

    public function __invoke(string $id)
    {
        $pack = $this->packService->findById($id);
        abort_unless($pack instanceof Pack, Response::HTTP_NOT_FOUND, 'No pack selected');

        if ($pack->price_type === Pack::PRICE_CYCLE_PERCENTAGE) {
            $this->subscriptionService->createWithPercentage(Auth::user(), $pack);

            return redirect()->route('dashboard');
        }

        return view('auth.subscription.pay', [
            'pack'              =>  $pack
        ]);
    }
}
