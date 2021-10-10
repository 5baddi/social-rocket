<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Common\Managers;

use Illuminate\Cache\Repository;

class CacheManager extends AbstractCacheManager
{
    public function __construct()
    {
        /** @var Repository */
        $this->cacheRepository = app(Repository::class);
    }
}