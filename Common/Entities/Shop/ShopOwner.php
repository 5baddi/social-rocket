<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Shop;

use App\Models\User;

class ShopOwner extends User
{
    public const SHOP_ID_COLUMN = 'shop_id';
    public const FULL_NAME_COLUMN = 'full_name';
    public const PHONE_COLUMN = 'phone';
    public const CUSTOMER_ID_COLUMN = 'customer_id';
}
