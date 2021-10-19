<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Pack;
use BADDIServices\SocialRocket\Common\Entities\Subscription\PackFeature;
use BADDIServices\SocialRocket\Common\Services\Service;
use Illuminate\Support\Arr;

class PackFeatureService extends Service
{
    public function __construct(
        private PackFeatureService $packFeatureService
    )
    {
        parent::__construct();
    }

    public function create(array $attributes): Pack
    {
        $attributes = Arr::only(
            $attributes,
            [
                PackFeature::PACK_ID_COLUMN,
                PackFeature::FEATURE_ID_COLUMN,
                PackFeature::VALUE_COLUMN,
                PackFeature::SORT_ORDER_COLUMN,
            ]
        );

        return $this->packFeatureService->create($attributes);
    }
}
