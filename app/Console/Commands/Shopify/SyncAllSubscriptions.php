<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands;

use Throwable;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Earning;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\EarningService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use Carbon\Carbon;

class SyncAllSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync subscriptions from shopify all stores';

    /** @var StoreService */
    private $storeService;

    /** @var SubscriptionService */
    private $subscriptionService;

    /** @var EarningService */
    private $earningService;

    /** @var ShopifyService */
    private $shopifyService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        StoreService $storeService,
        SubscriptionService $subscriptionService,
        EarningService $earningService,
        ShopifyService $shopifyService
    )
    {
        parent::__construct();

        $this->storeService = $storeService;
        $this->subscriptionService = $subscriptionService;
        $this->earningService = $earningService;
        $this->shopifyService = $shopifyService;
    }

    public function handle()
    {
        $stores = $this->storeService->all();

        $stores->each(function (Store $store) {
            try {
                if (!$store->subscription instanceof Subscription) {
                    return false;
                }

                $store->subscription->load('user');
                $store->subscription->load('pack');

                /** @var User */
                $user = $store->subscription->user;

                /** @var Pack */
                $pack = $store->subscription->pack;

                $billing = [];
                if ($store->subscription->isChargeSubscription()) {
                    $billing = $this->shopifyService->getBilling($store, $store->subscription->charge_id);
                } else {
                    $billing = $this->shopifyService->getUsageBilling($store, $store->subscription->usage_id);
                }

                if (sizeof($billing) === 0) {
                    return;
                }

                $subscription = $this->subscriptionService->save($user, $store, $pack, $billing);

                $earning = $this->earningService->save(
                    $store, 
                    [
                        Earning::USER_ID_COLUMN         => $user->id,
                        Earning::SUBSCRIPTION_ID_COLUMN => $subscription->id,
                        Earning::AMOUNT_COLUMN          => Arr::has($billing, 'trial_ends_on') ? 0.0 : Arr::get($billing, 'price'),
                        Earning::STATUS_COLUMN          => Arr::get($billing, Subscription::STATUS_COLUMN),
                        Earning::CANCELLED_ON_COLUMN    => Arr::get($billing, Subscription::CANCELLED_ON_COLUMN),
                    ]
                );

                sleep(10);
            } catch (Throwable $e) {
                AppLogger::setStore($store)->error($e, 'command:shopify:sync-subscriptions');

                return;
            }
        });
    }
}
