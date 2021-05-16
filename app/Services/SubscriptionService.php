<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Exception;
use App\Models\User;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Repositories\SubscriptionRepository;
use BADDIServices\SocialRocket\Notifications\Subscription\SubscriptionCancelled;

class SubscriptionService extends Service
{
    /** @var SubscriptionRepository */
    private $subscriptionRepository;
    
    /** @var ShopifyService */
    private $shopifyService;

    /** @var StoreService */
    private $storeService;

    public function __construct(SubscriptionRepository $subscriptionRepository, ShopifyService $shopifyService, StoreService $storeService)
    {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
    }

    public function loadRelations(Subscription &$subscription): Subscription
    {
        $subscription->load(['user', 'pack']);
        
        return $subscription;
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
                'name'          =>  ucwords($pack->name) . ' Trial',
                'capped_amount' =>  Pack::DEFAULT_MAX_USAGE_PRICE,
                'price'         =>  0,
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

        $subscription = $this->subscriptionRepository->save($user->id, $store->id, $pack->id, $billing->toArray());

        $this->createScriptTag($store);

        return $subscription;
    }

    public function createScriptTag(Store $store)
    {
        if (is_null($store->script_tag_id)) {
            $scriptTag = collect($this->shopifyService->createScriptTag($store));
            $this->storeService->udpate($store, [
                Store::SCRIPT_TAG_ID_COLUMN => $scriptTag->get('id')
            ]);
        }
    }
    
    public function confirmUsageBilling(User $user, Store $store, Pack $pack, string $chargeId): Subscription
    {
        $billing = collect($this->shopifyService->getUsageBilling($store, $chargeId));

        if ($pack->type === Pack::RECURRING_TYPE) {
            $billing->put(Subscription::CHARGE_ID_COLUMN, $billing->get('id', $chargeId));
        } else {
            $billing->put(Subscription::USAGE_ID_COLUMN, $billing->get('id', $chargeId));
        }

        $billing = $billing->only([
            Subscription::CHARGE_ID_COLUMN,
            Subscription::STATUS_COLUMN,
            Subscription::BILLING_ON_COLUMN,
            Subscription::ACTIVATED_ON_COLUMN,
            Subscription::TRIAL_ENDS_ON_COLUMN,
            Subscription::CANCELLED_ON_COLUMN,
            Subscription::CREATED_AT_COLUMN
        ]);

        $subscription = $this->subscriptionRepository->save($user->id, $store->id, $pack->id, $billing->toArray());
        $subscription->load(['user', 'pack']);

        $this->createScriptTag($store);

        return $subscription;
    }

    public function cancelSubscription(User $user, Store $store, Subscription $subscription): void
    {
        if ($subscription->charge_id === Subscription::CHARGE_CANCELLD) {
            throw new Exception('Subscription already cancelled');
        }

        $this->shopifyService->cancelSubscription($store, $subscription->charge_id);

        $this->subscriptionRepository->delete($subscription->id);

        $subscription->load('pack');

        $user->notify(new SubscriptionCancelled($subscription));
    }
}