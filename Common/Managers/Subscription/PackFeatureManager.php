<?php

namespace BADDIServices\SocialRocket\Common\Managers\Subscription;

use BADDIServices\SocialRocket\Common\Repositories\Subscription\PackFeatureRepository;
use BADDIServices\SocialRocket\Managers\Cache\CacheManager;

class PackFeatureManager extends CacheManager
{
    protected const CACHE_KEY = "packs:%s:features:%s";

    public function __construct(PackFeatureRepository $packFeatureRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $packFeatureRepository;
    }
}
