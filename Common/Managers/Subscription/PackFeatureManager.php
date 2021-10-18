<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers\Subscription;

use BADDIServices\SocialRocket\Common\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Common\Repositories\Subscription\PackFeatureRepository;

class PackFeatureManager extends CacheManager
{
    protected const CACHE_KEY = "pack:%s:feature:%s";

    public function __construct(PackFeatureRepository $packFeatureRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $packFeatureRepository;
    }
}
