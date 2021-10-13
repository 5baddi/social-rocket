<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Entities;


class OAuth extends Entity
{
    public const SHOP_ID_COLUMN = 'shop_id';
    public const CODE_COLUMN = 'code';
    public const ACCESS_TOKEN_COLUMN = 'access_token';
    public const SCOPE_COLUMN = 'scope';
    public const TIMESTAMP_COLUMN = 'timestamp';

    public function getShopId(): string
    {
        return $this->getAttribute(self::SHOP_ID_COLUMN);
    }

    public function getCode(): string
    {
        return $this->getAttribute(self::CODE_COLUMN);
    }

    public function getAccessToken(): string
    {
        return $this->getAttribute(self::ACCESS_TOKEN_COLUMN);
    }

    public function getScope(): string
    {
        return $this->getAttribute(self::SCOPE_COLUMN);
    }

    public function getTimestamp(): string
    {
        return $this->getAttribute(self::TIMESTAMP_COLUMN);
    }
}
