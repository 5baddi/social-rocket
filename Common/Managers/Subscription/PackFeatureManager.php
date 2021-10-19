<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers\Subscription;

use BADDIServices\SocialRocket\Common\Entities\Subscription\PackFeature;
use BADDIServices\SocialRocket\Common\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Common\Repositories\Subscription\PackFeatureRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PackFeatureManager extends CacheManager
{
    protected const CACHE_KEY = "pack-features:%s";

    public function __construct(PackFeatureRepository $packFeatureRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $packFeatureRepository;
    }
}
