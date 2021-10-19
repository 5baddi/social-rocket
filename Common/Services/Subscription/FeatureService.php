<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Feature;
use BADDIServices\SocialRocket\Common\Managers\Subscription\FeatureManager;
use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class FeatureService extends Service
{
    public function __construct(
        private FeatureManager $featureManager
    ) {
        parent::__construct();
    }

    public function all(): Collection
    {
        return $this->featureManager->all();
    }

    public function bulkCreate(array $features): array
    {
        $result = [];

        foreach ($features as $feature) {
            $result[] = $this->create($feature);
        }

        return $result;
    }

    public function create(array $attributes): Feature
    {
        $attributes = Arr::only(
            $attributes,
            [
                Feature::KEY_COLUMN,
                Feature::NAME_KEY_COLUMN,
                Feature::ICON_COLUMN,
                Feature::DESCRIPTION_COLUMN,
            ]
        );

        return $this->featureManager->create($attributes);
    }
}
