<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class OrderService extends Service
{
    /** @var OrderRepository */
    private $orderRepository;
    
    /** @var CommissionService */
    private $commissionService;

    public function __construct(OrderRepository $orderRepository, CommissionService $commissionService)
    {
        $this->orderRepository = $orderRepository;
        $this->commissionService = $commissionService;
    }

    public function latest(): ?Order
    {
        return $this->orderRepository->latest();
    }
    
    public function exists(Store $store, string $orderId): ?Order
    {
        return $this->orderRepository->exists($store->id, $orderId);
    }

    public function save(Store $store, array $attributes): Order
    {
        Arr::set($attributes, Order::STORE_ID_COLUMN, $store->id);
        Arr::set($attributes, Order::ORDER_ID_COLUMN, $attributes[Order::ID_COLUMN]);
        Arr::set($attributes, Order::CUSTOMER_ID_COLUMN, $attributes['customer'][Order::ID_COLUMN]);

        $attributes = collect($attributes)
                        ->only([
                            Order::STORE_ID_COLUMN,
                            Order::CUSTOMER_ID_COLUMN,
                            Order::ORDER_ID_COLUMN,
                            Order::CHECKOUT_ID_COLUMN,
                            Order::NAME_COLUMN,
                            Order::TOTAL_PRICE_COLUMN,
                            Order::TOTAL_PRICE_USD_COLUMN,
                            Order::CURRENCY_COLUMN,
                            Order::DISCOUNT_CODES_COLUMN,
                            Order::TOTAL_DISCOUNTS_COLUMN,
                            Order::CONFIRMED_COLUMN,
                            Order::CANCELLED_AT_COLUMN,
                        ])
                        ->toArray();

        return $this->orderRepository->save(
            [
                Order::ORDER_ID_COLUMN    => $attributes[Order::ORDER_ID_COLUMN],
                Order::STORE_ID_COLUMN    => $attributes[Order::STORE_ID_COLUMN],
                Order::CUSTOMER_ID_COLUMN => $attributes[Order::CUSTOMER_ID_COLUMN]
            ],
            $attributes
        );
    }

    public function whereInPeriod(Store $store, CarbonPeriod $period): Collection
    {
        return $this->orderRepository->where(
            $store->id,
            [
                [Order::CREATED_AT, '>=', $period->copy()->getStartDate()],
                [Order::CREATED_AT, '<=', $period->copy()->getEndDate()],
            ]
        );
    }
    
    public function getOrdersEarnings(Store $store, CarbonPeriod $period): float
    {
        return $this->orderRepository->getOrdersEarnings(
            $store->id, 
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate()
        );
    }
    
    public function getNewOrdersCount(Store $store, CarbonPeriod $period): int
    {
        return $this->orderRepository->getNewOrdersCount(
            $store->id, 
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate()
        );
    }
}