<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Pack;
use BADDIServices\SocialRocket\Common\Managers\Subscription\PackManager;
use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PackService extends Service
{
    public function __construct(
        private PackManager $packManager
    )
    {
        parent::__construct();
    }

    public function all(): Collection
    {
        return $this->packManager->all();
    }

    public function bulkCreate(array $packs): array
    {
        $result = [];

        foreach ($packs as $pack) {
            $result[] = $this->create($pack);
        }

        return $result;
    }

    public function create(array $attributes): Pack
    {
        $attributes = Arr::only(
            $attributes,
            [
                Pack::NAME_KEY_COLUMN,
                Pack::PRICE_COLUMN,
                Pack::TYPE_COLUMN,
                Pack::INTERVAL_COLUMN,
                Pack::REVENUE_SHARE_COLUMN,
                Pack::IS_POPULAR_COLUMN,
                Pack::TRIAL_DAYS_COLUMN,
                Pack::CURRENCY_COLUMN,
                Pack::CURRENCY_SYMBOL_COLUMN,
            ]
        );

        return $this->packManager->create($attributes);
    }
}
