<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pack extends Entity
{
    use SoftDeletes;

    /** @var string */
    public const NAME_KEY_COLUMN = 'name_key';
    public const PRICE_COLUMN = 'price';
    public const TYPE_COLUMN = 'type';
    public const INTERVAL_COLUMN = 'interval';
    public const REVENUE_SHARE_COLUMN = 'revenue_share';
    public const IS_POPULAR_COLUMN = 'is_popular';
    public const TRIAL_DAYS_COLUMN = 'trial_days';
    public const CURRENCY_COLUMN = 'currency';
    public const CURRENCY_SYMBOL_COLUMN = 'currency_symbol';

    public const PER_MONTH = 'month';
    public const PER_YEAR = 'year';

    /** @var int */
    public const DEFAULT_CHARGE_PRICE = 25;
    public const DEFAULT_MAX_USAGE_PRICE = 1000;
    public const DEFAULT_TRIAL_DAYS = 14;

    public const FREE_TYPE = 1;
    public const RECURRING_TYPE = 2;
    public const USAGE_TYPE = 3;

    /** @var array */
    public const INTERVALS = [
        self::PER_MONTH,
        self::PER_YEAR
    ];

    /** @var array */
    public const TYPES = [
        self::FREE_TYPE,
        self::RECURRING_TYPE,
        self::USAGE_TYPE
    ];

    /** @var array|Feature[] */
    private $features = [];

    public function getType(): ?int
    {
        return $this->getAttribute(self::TYPE_COLUMN);
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     * @param array|Feature[] $features
     */
    public function setFeatures(array $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function isFixedPrice(): bool
    {
        return $this->getType() === Pack::RECURRING_TYPE;
    }

    public function isUsageType(): bool
    {
        return $this->getAttribute(self::TYPE_COLUMN) === self::USAGE_TYPE;
    }

    public function getRevenueShare(): ?float
    {
        return $this->getAttribute(self::REVENUE_SHARE_COLUMN);
    }

    public function isFree(): bool
    {
        return $this->getType() === self::FREE_TYPE;
    }

    public function getName(): string
    {
        return trans(
            sprintf('packs.%s', $this->getAttribute(self::NAME_KEY_COLUMN))
        );
    }
}
