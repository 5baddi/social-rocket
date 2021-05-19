<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Console\Commands\Shopify;

use Throwable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Product;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ProductService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\MailListService;
use BADDIServices\SocialRocket\Services\CommissionService;

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
    
    /** @var ProductService */
    private $productService;
    
    /** @var MailListService */
    private $mailListService;
    
    /** @var CommissionService */
    private $commissionService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        StoreService $storeService, 
        ShopifyService $shopifyService, 
        OrderService $orderService,
        ProductService $productService,
        MailListService $mailListService,
        CommissionService $commissionService
    )
    {
        parent::__construct();

        $this->storeService = $storeService;
        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->mailListService = $mailListService;
        $this->commissionService = $commissionService;
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
                    $products = collect($order->get('line_items'), []);
                    $customer = collect($order->get('customer'), []);

                    $existsByCoupons = $discounts
                        ->whereIn('code', $coupons)
                        ->first();
                        
                    $existsByCoupon = $discounts->firstWhere('code', $store->coupon);

                    if (!is_null($existsByCoupons) || !is_null($existsByCoupon)) {
                        $order = $this->orderService->save($store, $order->toArray());

                        $customerId = $customer->get('id');
                        $affiliate = $this->mailListService->exists($customerId);
                        
                        if (is_null($affiliate)) {
                            $customer = $this->mailListService->create($store, $customer->toArray());
                        }

                        $this->commissionService->calculate($store, $affiliate, $order);
                        
                        $products->map(function ($item) use ($store) {
                            if (isset($item[Product::PRODUCT_ID_COLUMN])) {
                                $product = $this->shopifyService->getProduct($store, $item[Product::PRODUCT_ID_COLUMN]);

                                $this->productService->save($store, $product);
                            }
                        });
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
