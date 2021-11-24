<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Shop;

use BADDIServices\SocialRocket\Common\Entities\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Entity
{
    use SoftDeletes;

    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const DOMAIN_COLUMN = 'domain';
    public const SHOPIFY_DOMAIN_COLUMN = 'shopify_domain';
    public const SLUG_COLUMN = 'slug';
    public const PHONE_COLUMN = 'phone';
    public const CITY_COLUMN = 'city';
    public const COUNTRY_CODE_COLUMN = 'country_code';
    public const LOCALE_COLUMN = 'locale';
    public const CURRENCY_COLUMN = 'currency';
    public const CHECKOUT_API_SUPPORTED_COLUMN = 'checkout_api_supported';
    public const CONNECTED_AT_COLUMN = 'connected_at';
    public const IS_MAIN_SHOP_COLUMN = 'is_main_shop';
    public const ENABLED_COLUMN = 'enabled';
}
