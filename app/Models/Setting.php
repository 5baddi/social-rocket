<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

class Setting extends Model
{
    /** @var string */
    public const CURRENCY_COLUMN = 'currency';
    public const BRAND_NAME_COLUMN = 'brand_name';
    public const FIXED_TYPE = 'fixed';
    public const PERCENTAGE_TYPE = 'percentage';
    public const UNIQUE_DISCOUNT_FORMAT = 'unique';
    public const RANDOM_DISCOUNT_FORMAT = 'random';

    /** @var int */
    public const DFEAULT_COMMISSION = 10;
    public const DFEAULT_DISCOUNT= 10;

    /** @var array */
    public const COMMISSION_TYPES = [
        self::FIXED_TYPE,
        self::PERCENTAGE_TYPE,
    ];
    
    /** @var array */
    public const DISCOUNT_TYPES = [
        self::FIXED_TYPE,
        self::PERCENTAGE_TYPE,
    ];
    
    /** @var array */
    public const DISCOUNT_FORMATS = [
        self::UNIQUE_DISCOUNT_FORMAT    =>  'First Name + Unique Number',
        self::RANDOM_DISCOUNT_FORMAT    =>  'Random Letters + Numbers'
    ];
}
