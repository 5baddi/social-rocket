<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Entities;

use BADDIServices\Packages\Shopify\Database\Factories\ShopFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Shop extends Entity
{
    use HasFactory;

    public const USER_ID_COLUMN = 'user_id';
    public const NAME_COLUMN = 'name';
    public const SLUG_COLUMN = 'slug';
    public const EMAIL_COLUMN = 'email';
    public const DOMAIN_COLUMN = 'domain';
    public const PHONE_COLUMN = 'phone';
    public const COUNTRY_COLUMN = 'country';
    public const CONNECTED_AT_COLUMN = 'connected_at';
    public const IS_MAIN_SHOP_COLUMN = 'is_main_shop';
    public const IS_ACTIVE_COLUMN = 'is_active';

    protected static function newFactory()
    {
        return ShopFactory::new();
    }

    public function getUserId(): ?string
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function getName(): ?string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getSlug(): string
    {
        return $this->getAttribute(self::SLUG_COLUMN);
    }

    public function getEmail(): ?string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getDomain(): ?string
    {
        return $this->getAttribute(self::DOMAIN_COLUMN);
    }

    public function getPhone(): ?string
    {
        return $this->getAttribute(self::PHONE_COLUMN);
    }

    public function getCountry(): ?string
    {
        return $this->getAttribute(self::COUNTRY_COLUMN);
    }

    public function getConnectedAt(): ?carbon
    {
        return $this->getAttribute(self::CONNECTED_AT_COLUMN);
    }

    public function isMainShop(): bool
    {
        return $this->getAttribute(self::IS_MAIN_SHOP_COLUMN) === true;
    }

    public function isActive(): bool
    {
        return $this->getAttribute(self::IS_ACTIVE_COLUMN) === true;
    }
}
