<?php

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\EarningService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\SubscriptionService;

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

                $billing = [];
                if ($store->subscription->isChargeSubscription()) {
                    $billing = $this->shopifyService->getBilling($store, $store->subscription->charge_id);
                } else {
                    $billing = $this->shopifyService->getUsageBilling($store, $store->subscription->usage_id);
                }

                if (sizeof($billing) === 0) {
                    return;
                }

                // TODO: update subscription and earning
            } catch (Throwable $e) {
                AppLogger::setStore($store)->error($e, 'command:shopify:sync-subscriptions');

                return;
            }
        });
    }
}
