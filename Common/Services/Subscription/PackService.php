<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Feature;
use BADDIServices\SocialRocket\Common\Entities\Subscription\Pack;
use BADDIServices\SocialRocket\Common\Entities\Subscription\PackFeature;
use BADDIServices\SocialRocket\Common\Managers\Subscription\FeatureManager;
use BADDIServices\SocialRocket\Common\Managers\Subscription\PackFeatureManager;
use BADDIServices\SocialRocket\Common\Managers\Subscription\PackManager;
use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PackService extends Service
{
    public function __construct(
        private PackManager $packManager,
        private FeatureManager $featureManager,
        private PackFeatureManager $packFeatureManager
    ) {
        parent::__construct();
    }

    public function all(): Collection
    {
        $packs = $this->packManager->all();

        return $this->hydratePackFeatures($packs);
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
                Pack::KEY_COLUMN,
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

    public function getFreePack(): Pack
    {
        return $this->packManager->first([
            [Pack::PRICE_COLUMN, '=', 0]
        ]);
    }

    private function hydratePackFeatures(Collection $packs): Collection
    {
        $packsFeatures = $this->packFeatureManager->all();

        return $packs->map(function (Pack $pack) use ($packsFeatures) {
            $packFeatures = $packsFeatures
                ->where(PackFeature::PACK_ID_COLUMN, $pack->getId())
                ->map(function (PackFeature $packFeature) {
                    /** @var Feature */
                    $feature = $this->featureManager->findById($packFeature->getFeatureId());

                    $feature->setIsEnabled($packFeature->isEnabled());

                    return $feature;
                })
                ->sortBy(Feature::SORT_ORDER_COLUMN)
                ->all();

            $pack->setFeatures($packFeatures);

            return $pack;
        });
    }

    public function findByKey(int $key): ?Pack
    {
        return $this->packManager->findByKey($key);
    }
}
