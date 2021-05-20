<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

class Order extends BaseModel
{
    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const CUSTOMER_ID_COLUMN = 'customer_id';
    public const ORDER_ID_COLUMN = 'order_id';
    public const CHECKOUT_ID_COLUMN = 'checkout_id';
    public const NAME_COLUMN = 'name';
    public const TOTAL_PRICE_COLUMN = 'total_price';
    public const TOTAL_PRICE_USD_COLUMN = 'total_price_usd';
    public const CURRENCY_COLUMN = 'currency';
    public const PRODUCTS_IDS_COLUMN = 'products_ids';
    public const DISCOUNT_CODES_COLUMN = 'discount_codes';
    public const TOTAL_DISCOUNTS_COLUMN = 'total_discounts';
    public const CONFIRMED_COLUMN = 'confirmed';
    public const CANCELLED_AT_COLUMN = 'cancelled_at';
    
    /** @var array */
    protected $fillable = [
        self::STORE_ID_COLUMN,
        self::CUSTOMER_ID_COLUMN,
        self::ORDER_ID_COLUMN,
        self::CHECKOUT_ID_COLUMN,
        self::NAME_COLUMN,
        self::TOTAL_PRICE_COLUMN,
        self::TOTAL_PRICE_USD_COLUMN,
        self::CURRENCY_COLUMN,
        self::PRODUCTS_IDS_COLUMN,
        self::DISCOUNT_CODES_COLUMN,
        self::TOTAL_DISCOUNTS_COLUMN,
        self::CONFIRMED_COLUMN,
        self::CANCELLED_AT_COLUMN,
    ];

    /** @var array */
    protected $casts = [
        self::CUSTOMER_ID_COLUMN    => 'integer',
        self::ORDER_ID_COLUMN       => 'integer',
        self::CHECKOUT_ID_COLUMN    => 'integer',
        self::PRODUCTS_IDS_COLUMN   => 'json',
        self::DISCOUNT_CODES_COLUMN => 'json',
    ];

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, OrderProduct::class);
    }

    public function getDiscount(): Collection
    {
        return collect($this->getAttribute(self::DISCOUNT_CODES_COLUMN) ?? []);
    }
    
    public function getDiscountsIds(): Collection
    {
        return collect($this->getAttribute(self::PRODUCTS_IDS_COLUMN));
    }
}