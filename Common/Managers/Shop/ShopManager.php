<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers\Shop;

use BADDIServices\SocialRocket\Common\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Common\Repositories\Shop\ShopRepository;

class ShopManager extends CacheManager
{
    protected const CACHE_KEY = "shops:%s";

    public function __construct(ShopRepository $shopRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $shopRepository;
    }
}
