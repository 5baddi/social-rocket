<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Repositories\SubscriptionRepository;

class SubscriptionService extends Service
{
    /** @var SubscriptionRepository */
    private $subscriptionRepository;
    
    /** @var ShopifyService */
    private $shopifyService;

    public function __construct(SubscriptionRepository $subscriptionRepository, ShopifyService $shopifyService)
    {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->shopifyService = $shopifyService;
    }
    
    public function createBillingConfirmationURL(Store $store, Pack $pack): string
    {
        $charge = [
            'name'          =>  ucwords($pack->name),
            'trial_days'    =>  $pack->trial_days,
            'test'          =>  config('app.debug') ? true : null,
            'price'         =>  $pack->price,
            'return_url'    =>  route('subscription.billing.confirmation', ['pack' => $pack->id])
        ];

        if ($pack->type === Pack::USAGE_TYPE) {
            $charge = array_merge($charge, [
                'capped_amount' =>  $pack->price,
                'terms'         =>  $pack->price . '% of revenue share'
            ]);
        }

        return $this->shopifyService->createRecurringBillingURL($store, $charge);
    }

    public function confirmBilling(User $user, Store $store, Pack $pack, string $chargeId): Subscription
    {
        $billing = collect($this->shopifyService->getBilling($store, $chargeId));

        $billing->put(Subscription::CHARGE_ID_COLUMN, $billing->get('id', $chargeId));

        $billing = $billing->only([
            Subscription::CHARGE_ID_COLUMN,
            Subscription::STATUS_COLUMN,
            Subscription::BILLING_ON_COLUMN,
            Subscription::ACTIVATED_ON_COLUMN,
            Subscription::TRIAL_ENDS_ON_COLUMN,
            Subscription::CANCELLED_ON_COLUMN,
            Subscription::CREATED_AT_COLUMN
        ]);

        return $this->subscriptionRepository->save($user->id, $store->id, $pack->id, $billing->toArray());
    }
}