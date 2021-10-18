<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Entity
{
    use SoftDeletes;

    public const KEY_COLUMN = 'key';
    public const NAME_KEY_COLUMN = 'name_key';
    public const ICON_COLUMN = 'icon';
    public const DESCRIPTION_COLUMN = 'description';

    public const UNLIMITED_AFFILIATES = 1;
    public const REPORTING = 2;
    public const PAYOUT_METHODS = 3;
    public const SUPPORT = 4;
    public const CUSTOMIZATION = 5;
    public const REVENUE_NOT_SHARED = 6;
}
