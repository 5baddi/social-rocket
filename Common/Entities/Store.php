<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Common\Entities;

use BADDIServices\ClnkGO\Common\Entities\Entity;

class Store extends Entity
{   
    /** @var string */
    public const TABLE_NAME = 'stores';
    public const USER_ID_COLUMN = 'user_id';
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const DOMAIN_COLUMN = 'domain';
    public const MYSHOPIFY_DOMAIN_COLUMN = 'myshopify_domain';
    public const SLUG_COLUMN = 'slug';
    public const PHONE_COLUMN = 'phone';
    public const COUNTRY_COLUMN = 'country';
    public const SCRIPT_TAG_ID_COLUMN = 'script_tag_id';
    public const CONNECTED_AT_COLUMN = 'connected_at';
    public const ENABLED_COLUMN = 'enabled';
    public const SHOP_ID_COLUMN = 'shop_id';
    public const SHOP_OWNER_COLUMN = 'shop_owner';
    public const TIMEZONE_COLUMN = 'timezone';
    public const LOCALE_COLUMN = 'locale';
    public const CURRENCY_COLUMN = 'currency';
    public const CURRENCY_SYMBOL_COLUMN = 'currency_symbol';

    /** @var string */
    protected $table = self::TABLE_NAME;

    /** @var array */
    protected $casts = [
        self::ENABLED_COLUMN        => 'boolean',
        self::CONNECTED_AT_COLUMN   => 'datetime',
    ];

    public function isEnabled(): bool
    {
        return $this->getAttribute(self::ENABLED_COLUMN) === true;
    }
}