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
    public const SORT_ORDER_COLUMN = 'sort_order';

    public const UNLIMITED_AFFILIATES = 1;
    public const REPORTING = 2;
    public const PAYOUT_METHODS = 3;
    public const SUPPORT = 4;
    public const CUSTOMIZATION = 5;
    public const AUTOMATED_INTEGRATION = 6;
    public const REVENUE_NOT_SHARED = 7;

    /** @var bool */
    private $enabled = false;

    public function getKey(): int
    {
        return $this->getAttribute(self::KEY_COLUMN);
    }

    public function getName(): string
    {
        return trans(
            sprintf('packs.%s', $this->getAttribute(self::NAME_KEY_COLUMN))
        );
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setIsEnabled(bool $value): self
    {
        $this->enabled = $value;

        return $this;
    }
}
