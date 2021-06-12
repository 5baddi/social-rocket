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
use BADDIServices\SocialRocket\Models\OrderProduct;
use BADDIServices\SocialRocket\Models\Product;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class OrderService extends Service
{
    /** @var OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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
        $productsIds = collect($attributes['line_items'], [])->pluck('product_id');

        Arr::set($attributes, Order::STORE_ID_COLUMN, $store->id);
        Arr::set($attributes, Order::ORDER_ID_COLUMN, $attributes[Order::ID_COLUMN]);
        Arr::set($attributes, Order::CUSTOMER_ID_COLUMN, $attributes['customer'][Order::ID_COLUMN]);
        Arr::set($attributes, Order::PRODUCTS_IDS_COLUMN, $productsIds->toArray());

        $filteredAttributes = collect($attributes)
                        ->only([
                            Order::STORE_ID_COLUMN,
                            Order::CUSTOMER_ID_COLUMN,
                            Order::ORDER_ID_COLUMN,
                            Order::CHECKOUT_ID_COLUMN,
                            Order::NAME_COLUMN,
                            Order::TOTAL_PRICE_COLUMN,
                            Order::TOTAL_PRICE_USD_COLUMN,
                            Order::CURRENCY_COLUMN,
                            Order::PRODUCTS_IDS_COLUMN,
                            Order::DISCOUNT_CODES_COLUMN,
                            Order::TOTAL_DISCOUNTS_COLUMN,
                            Order::CONFIRMED_COLUMN,
                            Order::CANCELLED_AT_COLUMN,
                            Order::CREATED_AT,
                        ])
                        ->toArray();
                        
        return $this->orderRepository->save(
            [
                Order::ORDER_ID_COLUMN    => $attributes[Order::ORDER_ID_COLUMN],
                Order::STORE_ID_COLUMN    => $attributes[Order::STORE_ID_COLUMN],
                Order::CUSTOMER_ID_COLUMN => $attributes[Order::CUSTOMER_ID_COLUMN]
            ],
            $filteredAttributes
        );
    }
    
    public function attachProduct(Store $store, Order $order, Product $product, SupportCollection $items): OrderProduct
    {
        $amount = 0.0;
        $currency = Setting::DEFAULT_CURRENCY;

        $items->map(function ($item) use(&$amount, &$currency) {
            $item = collect($item);

            $priceSet = collect($item->get('price_set'));
            $money = collect($priceSet->get('shop_money'));

            $currency = $money->get('currency_code', Setting::CURRENCY_COLUMN);
            $amount .= $money->get('amount', 0.0);
        });

        return $this->orderRepository->attachProduct(
            [
                OrderProduct::STORE_ID_COLUMN           => $store->id,
                OrderProduct::ORDER_ID_COLUMN           => $order->id,
                OrderProduct::PRODUCT_ID_COLUMN         => $product->id,
            ],
            [
                OrderProduct::STORE_ID_COLUMN           => $store->id,
                OrderProduct::ORDER_ID_COLUMN           => $order->id,
                OrderProduct::PRODUCT_ID_COLUMN         => $product->id,
                OrderProduct::PRICE_COLUMN              => $amount,
                OrderProduct::CURRENCY_COLUMN           => $currency
            ]
        );
    }

    public function whereInPeriod(Store $store, CarbonPeriod $period): Collection
    {
        return $this->orderRepository->whereInPeriod(
            $store->id,
            $period->getStartDate(),
            $period->getEndDate()
        );
    }
    
    public function getOrdersProducts(Store $store, CarbonPeriod $period): Collection
    {
        return $this->orderRepository->getOrdersProducts(
            $store->id,
            $period->getStartDate(),
            $period->getEndDate()
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
    
    public function getAllOrdersEarnings(CarbonPeriod $period): float
    {
        return $this->orderRepository->getAllOrdersEarnings(
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate()
        );
    }
    
    public function getAllNewOrdersCount(CarbonPeriod $period): int
    {
        return $this->orderRepository->getAllNewOrdersCount(
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