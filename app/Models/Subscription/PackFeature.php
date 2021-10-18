<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models\Subscription;

use BADDIServices\SocialRocket\Entities\ModelEntity;

class PackFeature extends ModelEntity
{
    public const KEY_COLUMN = 'key';
    public const NAME_KEY_COLUMN = 'name_key';
    public const VALUE_COLUMN = 'value';
    public const ICON_COLUMN = 'icon';
    public const DESCRIPTION_COLUMN = 'description';

    public const UNLIMITED_AFFILIATES = 1;
    public const REPORTING = 2;
    public const PAYOUT_METHODS = 3;
    public const SUPPORT = 4;
    public const CUSTOMIZATION = 5;
    public const REVENUE_NOT_SHARED = 6;
}
