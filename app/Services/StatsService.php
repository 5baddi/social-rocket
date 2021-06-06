<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Commission;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Product;
use BADDIServices\SocialRocket\Models\OrderProduct;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\CommissionService;

class StatsService extends Service
{
    /** @var ShopifyService */
    private $shopifyService;
    
    /** @var OrderService */
    private $orderService;
    
    /** @var CommissionService */
    private $commissionService;

    public function __construct(ShopifyService $shopifyService, OrderService $orderService, CommissionService $commissionService)
    {
        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
        $this->commissionService = $commissionService;
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
                'amount'    =>  $this->commissionService->getTotalEarned($store, $commission->affiliate)
            ];
        });

        return $filteredAfiliates->toArray();
    }
}