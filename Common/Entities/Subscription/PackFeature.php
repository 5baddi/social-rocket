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
    public const ENABLED_COLUMN = 'enabled';

    public function getPackId(): string
    {
        return $this->getAttribute(self::PACK_ID_COLUMN);
    }

    public function getFeatureId(): string
    {
        return $this->getAttribute(self::FEATURE_ID_COLUMN);
    }

    public function isEnabled(): bool
    {
        return $this->getAttribute(self::ENABLED_COLUMN);
    }
}
