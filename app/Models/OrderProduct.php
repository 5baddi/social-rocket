<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use BADDIServices\ClnkGO\Entities\ModelEntity;

class OrderProduct extends ModelEntity
{
    /** @var string */
    public const TABLE_NAME = 'order_products';
    public const STORE_ID_COLUMN = 'store_id';
    public const ORDER_ID_COLUMN = 'order_id';
    public const PRODUCT_ID_COLUMN = 'product_id';
    public const PRICE_COLUMN = 'price';
    public const CURRENCY_COLUMN = 'currency';
}
