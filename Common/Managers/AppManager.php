<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers;

use BADDIServices\SocialRocket\Common\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Common\Repositories\AppRepository;

class AppManager extends CacheManager
{
    protected const CACHE_KEY = "app-settings:%s";

    public function __construct(AppRepository $appRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $appRepository;
    }
}
