<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Common\Store\Managers;

use BADDIServices\ClnkGO\Common\Managers\CacheManager;

class StoreManager extends CacheManager
{
    protected const CACHE_KEY = 'stores';
    protected const CACHE_TTL = 86400;
}