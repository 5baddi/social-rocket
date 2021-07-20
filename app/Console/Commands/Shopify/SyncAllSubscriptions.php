<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands;

use Throwable;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use BADDIServices\ClnkGO\AppLogger;
use BADDIServices\ClnkGO\Models\Pack;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\ClnkGO\Models\Earning;
use BADDIServices\ClnkGO\Models\Subscription;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\EarningService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Services\SubscriptionService;

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
        $this->info("Start stores purchase reminder");
        $startTime = microtime(true);

        try {
            $this->storeService->iterateOnActiveStores(
                function (Collection $stores) {
                    $stores->map(function (Store $store) {
                        try {
                            $store->load('subscription');

                            /** @var Subscription */
                            $subscription = $store->subscription;

                            $subscription->load('user');
                            $subscription->load('pack');

                            /** @var User */
                            $user = $subscription->user;

                            /** @var Pack */
                            $pack = $subscription->pack;

                            $billing = [];
                            if ($subscription->isChargeSubscription()) {
                                $billing = $this->shopifyService->getBilling($store, $subscription->charge_id);
                            } else {
                                $billing = $this->shopifyService->getUsageBilling($store, $pack, $subscription->usage_id);
                            }

                            if (sizeof($billing) === 0) {
                                return;
                            }

                            $subscription = $this->subscriptionService->save($user, $store, $pack, $billing);
                            if (in_array($subscription->status,  [Subscription::CHARGE_CANCELLD, Subscription::CHARGE_DECLINED, Subscription::CHARGE_EXPIRED])) {
                                $this->subscriptionService->cancelSubscription($user, $store, $subscription);
                            }

                            $this->earningService->save(
                                $store, 
                                [
                                    Earning::USER_ID_COLUMN         => $user->id,
                                    Earning::SUBSCRIPTION_ID_COLUMN => $subscription->id,
                                    Earning::AMOUNT_COLUMN          => Arr::has($billing, Subscription::TRIAL_ENDS_ON_COLUMN) ? 0.0 : Arr::get($billing, 'price'),
                                    Earning::STATUS_COLUMN          => Arr::get($billing, Subscription::STATUS_COLUMN),
                                    Earning::CANCELLED_ON_COLUMN    => Arr::get($billing, Subscription::CANCELLED_ON_COLUMN),
                                ]
                            );

                            sleep(10);
                        } catch (Throwable $e) {
                            AppLogger::setStore($store ?? null)->error($e, 'command:shopify:sync-subscriptions');
                        }
                    });
                } 
            );
        } catch (Throwable $e) {
            AppLogger::error($e, 'command:shopify:sync-subscriptions', ['execution_time' => (microtime(true) - $startTime)]);
            $this->error(sprintf("Error while sync stores subscriptions %s", $e->getMessage()));

            return;
        }
    }
}
