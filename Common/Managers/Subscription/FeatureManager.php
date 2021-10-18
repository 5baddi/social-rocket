<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers\Subscription;

use BADDIServices\SocialRocket\Common\Repositories\Subscription\FeatureRepository;
use BADDIServices\SocialRocket\Managers\Cache\CacheManager;

class FeatureManager extends CacheManager
{
    protected const CACHE_KEY = "features:%s";

    public function __construct(FeatureRepository $featureRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $featureRepository;
    }
}
