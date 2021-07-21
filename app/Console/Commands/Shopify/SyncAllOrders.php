<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands\Shopify;

use BADDIServices\ClnkGO\Logger;
use BADDIServices\ClnkGO\Models\Commission;
use Throwable;
use Illuminate\Console\Command;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Product;
use BADDIServices\ClnkGO\Models\Subscription;
use BADDIServices\ClnkGO\Services\OrderService;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\ProductService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Services\CommissionService;

class SyncAllOrders extends Command
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

    /** @var Logger */
    private $logger;
    
    /** @var StoreService */
    private $storeService;
    
    /** @var ShopifyService */
    private $shopifyService;

    /** @var OrderService */
    private $orderService;
    
    /** @var ProductService */
    private $productService;
    
    /** @var UserService */
    private $userService;
    
    /** @var CommissionService */
    private $commissionService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Logger $logger,
        StoreService $storeService, 
        ShopifyService $shopifyService, 
        OrderService $orderService,
        ProductService $productService,
        UserService $userService,
        CommissionService $commissionService
    )
    {
        parent::__construct();

        $this->logger = $logger;
        $this->storeService = $storeService;
        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->userService = $userService;
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

                $coupons = $this->userService->coupons($store);

                $orders = collect($this->shopifyService->getOrders($store));
                $orders->map(function ($order) use ($store, $coupons) {
                    $order = collect($order);
                    $discounts = collect($order->get('discount_codes', []));
                    $products = collect($order->get('line_items'), []);
                    $customer = collect($order->get('customer'), []);

                    $existsByCoupons = $discounts
                        ->whereIn('code', $coupons)
                        ->first();

                    if (!is_null($existsByCoupons)) {
                        $order = $this->orderService->save($store, $order->toArray());

                        $customerId = $customer->get('id');
                        $affiliate = $this->userService->exists($customerId);
                        
                        if (is_null($affiliate)) {
                            $customer = $this->userService->create($store, $customer->toArray());
                        }

                        $commission = $this->commissionService->exists($store, $affiliate, $order);
                        if (!$commission instanceof Commission) {
                            $this->commissionService->calculate($store, $affiliate, $order);

                            event();
                        }
                        
                        $products->map(function ($item) use ($store, $order, $products) {
                            if (isset($item[Product::PRODUCT_ID_COLUMN])) {
                                $product = $this->shopifyService->getProduct($store, $item[Product::PRODUCT_ID_COLUMN]);

                                $product = $this->productService->save($store, $product);
                                $this->orderService->attachProduct($store, $order, $product, $products);
                            }
                        });
                    }
                });

                sleep(10);
            });
        } catch (Throwable $e) {
            $this->logger->error($e, 'command:shopify:sync-orders');

            return;
        }
    }
}
