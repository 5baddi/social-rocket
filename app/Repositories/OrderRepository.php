<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function latest(): ?Order
    {
        return Order::query()
                    ->latest()
                    ->first();
    }
    
    public function exists(string $storeId, string $orderId): ?Order
    {
        return Order::query()
                    ->where([
                        Order::STORE_ID_COLUMN => $storeId,
                        Order::ORDER_ID_COLUMN => $orderId
                    ])
                    ->first();
    }
    
    public function save(array $attributes, array $values): Order
    {
        return Order::query()
                    ->updateOrCreate(
                        $attributes,
                        $values
                    );
    }

    public function where(string $storeId, array $attributes): Collection
    {
        return Order::query()
            ->where(Order::STORE_ID_COLUMN, $storeId)
            ->where($attributes)
            ->get();
    }
    
    public function getOrdersEarnings(string $storeId, Carbon $startDate, carbon $endDate): float
    {
        return Order::query()
            ->where([
                Order::STORE_ID_COLUMN => $storeId
            ])
            ->whereDate(
                Order::CREATED_AT,
                '>=',
                $startDate
            )
            ->whereDate(
                Order::CREATED_AT,
                '<=',
                $endDate
            )
            ->sum(Order::TOTAL_PRICE_USD_COLUMN);
    }
    
    public function getNewOrdersCount(string $storeId, Carbon $startDate, carbon $endDate): int
    {
        return Order::query()
            ->where([
                Order::STORE_ID_COLUMN => $storeId
            ])
            ->whereDate(
                Order::CREATED_AT,
                '>=',
                $startDate
            )
            ->whereDate(
                Order::CREATED_AT,
                '<=',
                $endDate
            )
            ->count();
    }
}