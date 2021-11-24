<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Shop;

use BADDIServices\SocialRocket\Common\Entities\Entity;

class ShopOauth extends Entity
{
    public const TABLE_NAME = 'shop_oauth';
    public const SHOP_ID_COLUMN = 'shop_id';
    public const CODE_COLUMN = 'code';
    public const ACCESS_TOKEN_COLUMN = 'access_token';
    public const SCOPES_COLUMN = 'scopes';
    public const TIMESTAMP_COLUMN = 'timestamp';

    protected $table = self::TABLE_NAME;
}
