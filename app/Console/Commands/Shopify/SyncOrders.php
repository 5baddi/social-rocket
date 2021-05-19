<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Console\Commands\Shopify;

use Throwable;
use Illuminate\Console\Command;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\MailListService;
use Illuminate\Support\Facades\Log;

class SyncOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync orders from shopify store';

    /** @var StoreService */
    private $storeService;
    
    /** @var ShopifyService */
    private $shopifyService;

    /** @var OrderService */
    private $orderService;
    
    /** @var MailListService */
    private $mailListService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        StoreService $storeService, 
        ShopifyService $shopifyService, 
        OrderService $orderService,
        MailListService $mailListService
    )
    {
        parent::__construct();

        $this->storeService = $storeService;
        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
        $this->mailListService = $mailListService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $stores = $this->storeService->all();

            $stores->each(function (Store $store) {
                if (!$store->subscription instanceof Subscription) {
                    return false;
                }

                $coupons = $this->mailListService->coupons($store);

                $orders = collect($this->shopifyService->getOrders($store));
                $orders->map(function ($order) use ($store, $coupons) {
                    $order = collect($order);
                    $discounts = collect($order->get('discount_codes', []));
                    
                    $exists = $discounts
                        ->whereIn('code', $coupons)
                        ->firstWhere('code', $store->coupon);
                    if (!is_null($exists)) {
                        $this->orderService->save($store, $order->toArray());

                        // TODO: Save order customer and product
                    }
                });
            });
        } catch (Throwable $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'command:shopify-sync-orders',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            return 0;
        }
    }
}
