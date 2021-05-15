<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\PackService;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use BADDIServices\SocialRocket\Http\Requests\BillingConfirmationRequest;

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
        /** @var User */
        $user = Auth::user();
        $user->load('store');

        $store = $user->store;
        abort_unless($store instanceof Store, Response::HTTP_NOT_FOUND, 'Store not found');
        
        $pack = $this->packService->findById($packId);
        abort_unless($pack instanceof Pack, Response::HTTP_NOT_FOUND, 'No pack selected');

        $this->subscriptionService->createAcceptBillingURL($store, $pack, $request->query('charge_id'));
    }
}