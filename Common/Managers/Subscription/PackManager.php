<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers\Subscription;

use BADDIServices\SocialRocket\Common\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Common\Repositories\Subscription\PackRepository;

class PackManager extends CacheManager
{
    protected const CACHE_KEY = "packs:%s";

    public function __construct(PackRepository $packRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $packRepository;
    }
}
