<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Entity;

class PackFeature extends Entity
{
    public const PACK_ID_COLUMN = 'pack_id';
    public const FEATURE_ID_COLUMN = 'feature_id';
    public const VALUE_COLUMN = 'value';
    public const SORT_ORDER_COLUMN = 'sort_order';
}
