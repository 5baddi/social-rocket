<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BADDIServices\SocialRocket\Entities\ModelEntity;

class Pack extends ModelEntity
{
    use SoftDeletes;

    /** @var string */
    public const PER_MONTH = 'month';
    public const PER_YEAR = 'year';
    public const FEATURES_COLUMN = 'features';
    public const PRICE_COLUMN = 'price';
    public const TYPE_COLUMN = 'type';
    public const INTERVAL_COLUMN = 'interval';
    public const FREE_TYPE = 1;
    public const RECURRING_TYPE = 2;
    public const USAGE_TYPE = 3;
    public const IS_POPULAR_TYPE = 'is_popular';

    /** @var int */
    public const DEFAULT_CHARGE_PRICE = 10;
    public const DEFAULT_MAX_USAGE_PRICE = 1000;
    public const DEFAULT_TRIAL_DAYS = 14;
    public const UNLIMITED_AFFILIATES = 1;
    public const PAYOUT_METHODS = 2;
    public const REPORTING = 3;
    public const CUSTOMIZATION = 4;
    public const SUPPORT = 5;
    public const REVENUE_NOT_SHARED = 6;
    public const STAFF = 7;

    /** @var array */
    public const INTERVAL = [
        self::PER_MONTH,
        self::PER_YEAR
    ];

    /** @var array */
    public const TYPES = [
        self::FREE_TYPE,
        self::RECURRING_TYPE,
        self::USAGE_TYPE
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function getFeaturesAttribute(): array
    {
        return json_decode($this->attributes[self::FEATURES_COLUMN], true);
    }

    public function setFeaturesAttribute($value): self
    {
        $this->attributes[self::FEATURES_COLUMN] = json_encode($value);

        return $this;
    }

    public function isFixedPrice(): bool
    {
        return $this->attributes[self::TYPE_COLUMN] === self::TYPES[0];
    }

    public function isUsageType(): bool
    {
        return $this->getAttribute(self::TYPE_COLUMN) === self::USAGE_TYPE;
    }
}
