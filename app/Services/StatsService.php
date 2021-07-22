<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use BADDIServices\ClnkGO\Models\Order;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Product;
use BADDIServices\ClnkGO\Models\Commission;
use BADDIServices\ClnkGO\Models\Earning;
use BADDIServices\ClnkGO\Models\OrderProduct;
use BADDIServices\ClnkGO\Models\Subscription;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Services\OrderService;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\EarningService;
use BADDIServices\ClnkGO\Services\Shopify\ShopifyService;
use BADDIServices\ClnkGO\Services\CommissionService;
use BADDIServices\ClnkGO\Services\SubscriptionService;

class StatsService extends Service
{
    /** @var ShopifyService */
    private $shopifyService;
    
    /** @var OrderService */
    private $orderService;
    
    /** @var CommissionService */
    private $commissionService;
    
    /** @var UserService */
    private $userService;

    /** @var StoreService */
    private $storeService;
    
    /** @var SubscriptionService */
    private $subscriptionService;

    /** @var EarningService */
    private $earningService;

    public function __construct(
        ShopifyService $shopifyService, 
        OrderService $orderService, 
        CommissionService $commissionService,
        UserService $userService,
        StoreService $storeService,
        SubscriptionService $subscriptionService,
        EarningService $earningService
    )
    {
        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
        $this->commissionService = $commissionService;
        $this->userService = $userService;
        $this->storeService = $storeService;
        $this->subscriptionService = $subscriptionService;
        $this->earningService = $earningService;
    }

    public function getLast7DaysPeriod(): CarbonPeriod
    {
        $now = Carbon::now();
        $queryInterval = new CarbonPeriod();
        $startDate = $now->copy()->subDays(7)->startOfDay();
        $endDate = $now->copy()->endOfDay();

        return $queryInterval
                    ->setStartDate($startDate)
                    ->setEndDate($endDate);
    }
    
    public function getPeriod(Carbon $startDate, Carbon $endDate): CarbonPeriod
    {
        return CarbonPeriod::create($startDate, $endDate);
    }

    public function getOrdersEarnings(Store $store, CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->orderService->getOrdersEarnings($store, $period)
        );
    }
    
    public function getAllOrdersEarnings(CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->orderService->getAllOrdersEarnings($period)
        );
    }
    
    public function getAllNewOrdersCount(CarbonPeriod $period): string
    {
        return $this->orderService->getAllNewOrdersCount($period);
    }
    
    public function getOrdersEarningsChart(Store $store, CarbonPeriod $period): array
    {
        $orders = $this->orderService->whereInPeriod($store, $period);

        $filteredOrders = $orders->map(function (Order $order) {
            return [
                'x' => $order->created_at->toDateString(),
                'y' => number_format($order->total, 2, '.', '')
            ];
        });
        
        return $filteredOrders->toArray();
    }
    
    public function getOrdersTopProducts(Store $store, CarbonPeriod $period): array
    {
        $orders = $this->orderService->getOrdersProducts($store, $period);

        $products = [];
        
        $orders->map(function (Order $order) use (&$products) {
            $products = array_merge($products, $order->products->toArray());
        });

        $products = collect($products);
        $productsIds = $products->groupBy(Product::ID_COLUMN)
                                ->unique()
                                ->keys()
                                ->take(5);

        $filteredProducts = $productsIds
            ->map(function (string $id) use ($store, $products) {
                $product = $products->where(Product::ID_COLUMN, $id)->first();

                if(is_null($product)) {
                    return null;
                }

                $sales = $products->where(Product::ID_COLUMN, $id)->sum('pivot.price');

                return [
                    Product::PRODUCT_ID_COLUMN      => $product[Product::PRODUCT_ID_COLUMN],
                    Product::TITLE_COLUMN           => $product[Product::TITLE_COLUMN],
                    Product::SLUG_COLUMN            => $product[Product::SLUG_COLUMN],
                    Product::IMAGE_COLUMN           => $product[Product::IMAGE_COLUMN],
                    OrderProduct::CURRENCY_COLUMN   => $product['pivot'][OrderProduct::CURRENCY_COLUMN],
                    'sales'                         => $sales,
                    'url'                           => $this->shopifyService->getProductURL($store, $product[Product::SLUG_COLUMN])
                ];
            })
            ->reject(function ($value) {
                return is_null($value);
            });

        return $filteredProducts->sortByDesc('sales')->toArray();
    }
    
    public function getNewOrdersCount(Store $store, CarbonPeriod $period): int
    {
        return $this->orderService->getNewOrdersCount($store, $period);
    }

    public function getPaidOrdersCommissions(Store $store, CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->commissionService->getPaidOrdersCommissions($store, $period)
        );
    }
    
    public function getUnpaidOrdersCommissions(Store $store, CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->commissionService->getUnpaidOrdersCommissions($store, $period)
        );
    }

    public function getTopAffiliatesByStore(Store $store, CarbonPeriod $period, int $limit = 5): array
    {
        $affiliates = $this->commissionService->getTopAffiliatesByStore($store, $period, $limit);

        $filteredAfiliates = $affiliates->map(function (Commission $commission) use ($store) {
            return [
                'fullname'  =>  $commission->affiliate->getFullName(),
                'sales'     =>  $commission->order->total_price_usd,
                'amount'    =>  $this->commissionService->getTotalEarnedByStore($store, $commission->affiliate)
            ];
        });

        return $filteredAfiliates->toArray();
    }

    public function getAllNewAffiliatesCount(CarbonPeriod $period): string
    {
        return $this->userService->getAllNewAffiliatesCount($period);
    }
    
    public function getAllNewVerifiedAffiliatesCount(CarbonPeriod $period): string
    {
        return $this->userService->getAllNewVerifiedAffiliatesCount($period);
    }
    
    public function getNewStoresCount(CarbonPeriod $period): string
    {
        return $this->storeService->getAllNewStoresCount($period);
    }
    
    public function getNewActiveStoresCount(CarbonPeriod $period): string
    {
        return $this->storeService->getAllNewActiveStoresCount($period);
    }

    public function getSubscriptionsEarnings(CarbonPeriod $period): string
    {
        return sprintf(
            '%.2f',
            $this->earningService->getEarnings($period)
        );
    }

    public function getActiveSubscriptionsCount(CarbonPeriod $period): int
    {
        return $this->subscriptionService->countByPeriod(
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate(),
            [
                Subscription::STATUS_COLUMN => Subscription::ACTIVE_STATUS
            ]
        );
    }

    public function getSubscriptionsEarningsChart(CarbonPeriod $period): array
    {
        $earnings = $this->earningService->whereInPeriod($period);

        $filteredEarnings = $earnings->map(function (Earning $earning) {
            return [
                'x' => $earning->created_at->toDateString(),
                'y' => number_format($earning->total, 2, '.', '')
            ];
        });
        
        return $filteredEarnings->toArray();
    }

    public function getTopAffiliates(CarbonPeriod $period, int $limit = 5): array
    {
        $affiliates = $this->commissionService->getTopAffiliates($period, $limit);

        $filteredAfiliates = $affiliates->map(function (Commission $commission) {
            return [
                'fullname'  =>  $commission->affiliate->getFullName(),
                'sales'     =>  $commission->order->total_price_usd,
                'amount'    =>  $this->commissionService->getTotalEarned($commission->affiliate)
            ];
        });

        return $filteredAfiliates->toArray();
    }

    public function getTopProducts(CarbonPeriod $period): array
    {
        $orders = $this->orderService->getProducts($$period);

        $products = [];
        
        $orders->map(function (Order $order) use (&$products) {
            $products = array_merge($products, $order->products->toArray());
        });

        $products = collect($products);
        $productsIds = $products->groupBy(Product::ID_COLUMN)
                                ->unique()
                                ->keys()
                                ->take(5);

        $filteredProducts = $productsIds
            ->map(function (string $id) use ($products) {
                $product = $products->where(Product::ID_COLUMN, $id)->first();

                if(is_null($product)) {
                    return null;
                }

                $sales = $products->where(Product::ID_COLUMN, $id)->sum('pivot.price');

                return [
                    Product::PRODUCT_ID_COLUMN      => $product[Product::PRODUCT_ID_COLUMN],
                    Product::TITLE_COLUMN           => $product[Product::TITLE_COLUMN],
                    Product::SLUG_COLUMN            => $product[Product::SLUG_COLUMN],
                    Product::IMAGE_COLUMN           => $product[Product::IMAGE_COLUMN],
                    OrderProduct::CURRENCY_COLUMN   => $product['pivot'][OrderProduct::CURRENCY_COLUMN],
                    'sales'                         => $sales,
                    // 'url'                           => $this->shopifyService->getProductURL($product[Product::SLUG_COLUMN]) TODO: fix URL
                ];
            })
            ->reject(function ($value) {
                return is_null($value);
            });

        return $filteredProducts->sortByDesc('sales')->toArray();
    }
}