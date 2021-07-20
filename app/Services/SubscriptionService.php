<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Services;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use BADDIServices\ClnkGO\Models\Pack;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use BADDIServices\ClnkGO\Models\Subscription;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Repositories\SubscriptionRepository;
use BADDIServices\ClnkGO\Notifications\Subscription\SubscriptionCancelled;
use BADDIServices\ClnkGO\Events\Subscription\SubscriptionCancelled as SubscriptionCancelledEvent;

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
    
    public function getUsageBills(): Collection
    {
        return $this->subscriptionRepository->getUsageBills();
    }
    
    public function createBillingConfirmationURL(Store $store, Pack $pack): string
    {
        $charge = [
            'name'          =>  ucwords($pack->name),
            'trial_days'    =>  $pack->trial_days,
            'test'          =>  config('shopify.test_enabled'),
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
        if ($pack->isUsageType()) {
            $billing = collect($this->shopifyService->getUsageBilling($store, $pack, $chargeId));

            $billing->put(Subscription::CHARGE_ID_COLUMN, $billing->get('id', $chargeId));
            $billing->put(Subscription::USAGE_ID_COLUMN, $billing->get('id', $billing->get('id')));
        } else {
            $billing = collect($this->shopifyService->getBilling($store, $chargeId));

            $billing->put(Subscription::CHARGE_ID_COLUMN, $billing->get('id', $chargeId));
        }

        $billing = $billing->only([
            Subscription::USAGE_ID_COLUMN,
            Subscription::CHARGE_ID_COLUMN,
            Subscription::STATUS_COLUMN,
            Subscription::BILLING_ON_COLUMN,
            Subscription::ACTIVATED_ON_COLUMN,
            Subscription::TRIAL_ENDS_ON_COLUMN,
            Subscription::CANCELLED_ON_COLUMN,
            Subscription::CREATED_AT_COLUMN
        ]);

        $subscription = $this->save($user, $store, $pack, $billing->toArray());

        $this->createScriptTag($store);

        return $subscription;
    }
    
    public function save(User $user, Store $store, Pack $pack, array $billing): Subscription
    {
        $billing = collect($billing);

        $billing = $billing->only([
            Subscription::USAGE_ID_COLUMN,
            Subscription::CHARGE_ID_COLUMN,
            Subscription::STATUS_COLUMN,
            Subscription::BILLING_ON_COLUMN,
            Subscription::ACTIVATED_ON_COLUMN,
            Subscription::TRIAL_ENDS_ON_COLUMN,
            Subscription::CANCELLED_ON_COLUMN,
            Subscription::CREATED_AT_COLUMN
        ]);

        $subscription = $this->subscriptionRepository->save($user->id, $store->id, $pack->id, $billing->toArray());

        return $subscription;
    }

    public function createScriptTag(Store $store)
    {
        if (is_null($store->script_tag_id)) {
            $scriptTag = collect($this->shopifyService->createScriptTag($store));
            $this->storeService->update($store, [
                Store::SCRIPT_TAG_ID_COLUMN => $scriptTag->get('id')
            ]);
        }
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

        Event::dispatch(new SubscriptionCancelledEvent($user, $subscription));
    }

    public function paginateWithRelations(?int $page = null): LengthAwarePaginator
    {
        return $this->subscriptionRepository->paginateWithRelations($page);
    }

    public function countByPeriod(Carbon $startDate, carbon $endDate, array $conditions = []): int
    {
        return Subscription::query()
                    ->whereDate(
                        Store::CREATED_AT,
                        '>=',
                        $startDate
                    )
                    ->whereDate(
                        Store::CREATED_AT,
                        '<=',
                        $endDate
                    )
                    ->where($conditions)
                    ->count();
    }
}