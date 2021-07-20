<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use BADDIServices\ClnkGO\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\ClnkGO\Models\OrderProduct;

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
    
    public function attachProduct(array $attributes, array $values): OrderProduct
    {
        return OrderProduct::query()
                    ->updateOrCreate(
                        $attributes,
                        $values
                    );
    }

    public function whereInPeriod(string $storeId, Carbon $startDate, Carbon $endDate): Collection
    {
        return Order::query()
            ->select(DB::raw('SUM(total_price_usd) as total'), Order::CREATED_AT, DB::raw('DATE(created_at) as date'))
            ->where(Order::STORE_ID_COLUMN, $storeId)
            ->where(Order::CREATED_AT, '>=', $startDate)
            ->where(Order::CREATED_AT, '<=', $endDate)
            ->groupBy('date')
            ->orderBy(Order::CREATED_AT, 'ASC')
            ->get();
    }
    
    public function getProducts(Carbon $startDate, Carbon $endDate): Collection
    {
        return Order::query()
            ->with('products')
            ->where(Order::CREATED_AT, '>=', $startDate)
            ->where(Order::CREATED_AT, '<=', $endDate)
            ->get();
    }
    
    public function getOrdersProducts(string $storeId, Carbon $startDate, Carbon $endDate): Collection
    {
        return Order::query()
            ->with('products')
            ->where(Order::STORE_ID_COLUMN, $storeId)
            ->where(Order::CREATED_AT, '>=', $startDate)
            ->where(Order::CREATED_AT, '<=', $endDate)
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
    
    public function getAllOrdersEarnings(Carbon $startDate, carbon $endDate): float
    {
        return Order::query()
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
    
    public function getAllNewOrdersCount(Carbon $startDate, carbon $endDate): int
    {
        return Order::query()
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