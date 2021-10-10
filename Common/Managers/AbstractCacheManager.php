<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Common\Managers;

use Illuminate\Cache\Repository;

abstract class AbstractCacheManager
{
    protected const CACHE_KEY = 'cache';
    protected const CACHE_TTL = 300;
    
    /** @var Repository */
    protected $cacheRepository;

    protected function getKey(string $key): string
    {
        return sprintf('%s-%s-%s', config('app.env'), self::CACHE_KEY, $key);
    }

    protected function findById(string $id): mixed
    {
        $key = $this->getKey($id);

        return $this->cacheRepository->get($key);
    }

    protected function set(string $key, mixed $value): bool
    {
        return $this->cacheRepository->put(
            $this->getKey($key),
            $value,
            self::CACHE_TTL
        );
    }

    protected function invalidate(string $key): bool
    {
        return $this->cacheRepository->forget(
            $this->getKey($key)
        );
    }
}