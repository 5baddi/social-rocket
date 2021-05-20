<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Product;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\CommissionService;

class StatsService extends Service
{
    /** @var ShopifyService */
    private $shopifyService;
    
    /** @var OrderService */
    private $orderService;
    
    /** @var ProductService */
    private $productService;
    
    /** @var CommissionService */
    private $commissionService;

    public function __construct(ShopifyService $shopifyService, OrderService $orderService, ProductService $productService, CommissionService $commissionService)
    {
        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
        $this->productService = $productService;
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
                $order->created_at->format('Y, m, d'),
                $order->total_price_usd
            ];
        });
        
        return $filteredOrders->toArray();
    }
    
    public function getOrdersTopProducts(Store $store, CarbonPeriod $period): array
    {
        $orders = $this->orderService->getOrdersProductsIds($store, $period);

        $productsIds = [];
        
        $orders->map(function (Order $order) use (&$productsIds) {
            $productsIds = array_merge($productsIds, $order->products_ids);
        });

        $productsIds = collect($productsIds)->unique()->toArray();
        
        $topProducts = $this->productService->getTopByIds($productsIds);

        $filteredProducts = $topProducts->map(function (Product $product) use ($store) {
            return [
                Product::PRODUCT_ID_COLUMN  => $product->product_id,
                Product::TITLE_COLUMN       => $product->title,
                Product::SLUG_COLUMN        => $product->slug,
                Product::IMAGE_COLUMN       => $product->image,
                'url'                       => $this->shopifyService->getProductURL($store, $product->slug)
            ];
        });

        return $filteredProducts->toArray();
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
}