<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

class Product extends BaseModel
{
    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const PRODUCT_ID_COLUMN = 'product_id';
    public const TITLE_COLUMN = 'title';
    public const SLUG_COLUMN = 'slug';

    /** @var array */
    protected $fillable = [
        self::STORE_ID_COLUMN,
        self::PRODUCT_ID_COLUMN,
        self::TITLE_COLUMN,
        self::SLUG_COLUMN
    ];
}