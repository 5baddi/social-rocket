<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Entities\ModelEntity;

class OrderProduct extends ModelEntity
{
    /** @var string */
    public const TABLE_NAME = 'order_products';
    public const STORE_ID_COLUMN = 'store_id';
    public const ORDER_ID_COLUMN = 'order_id';
    public const PRODUCT_ID_COLUMN = 'product_id';
    public const PRICE_COLUMN = 'price';
    public const CURRENCY_COLUMN = 'currency';

    /** @var array */
    protected $fillable = [
        self::STORE_ID_COLUMN,
        self::ORDER_ID_COLUMN,
        self::PRODUCT_ID_COLUMN,
        self::PRICE_COLUMN,
        self::CURRENCY_COLUMN,
    ];
}
