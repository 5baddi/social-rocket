<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Managers\Cache;

use BADDIServices\SocialRocket\Common\Repositories\EloquentRepository;
use Illuminate\Support\Collection;
use BADDIServices\SocialRocket\Logger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Cache\Repository;
use BADDIServices\SocialRocket\FeatureList;
use BADDIServices\SocialRocket\Entities\ModelEntity;
use BADDIServices\SocialRocket\Repositories\UserRespository;

class CacheManager
{
    protected const CACHE_KEY = "general:%s";
    protected const CACHE_TTL = 7200;

    /** @var Repository */
    protected $cacheRepository;

    /** @var Logger */
    protected $logger;

    /** @var EloquentRepository|UserRespository */
    protected $eloquentRepository;

    public function __construct()
    {
        /** @var Repository */
        $this->cacheRepository = app(Repository::class);

        /** @var Logger */
        $this->logger = app(Logger::class);
    }

    /**
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $cacheKey = $this->getCacheKey($key);

        $this->logger->debug(
            'getting resource from cache',
            [
                'feature'     => FeatureList::CACHE,
                'resource.id' => $key,
                'extra'       => ['cacheKey' => $cacheKey]
            ]
        );

        return $this->cacheRepository->get($cacheKey, $default);
    }

    public function set($key, $value, $ttl = self::CACHE_TTL): bool
    {
        $cacheKey = $this->getCacheKey($key);

        $this->logger->debug(
            'setting resource in cache',
            [
                'feature'       => FeatureList::CACHE,
                'resource.id'   => $key,
                'resource_type' => is_object($value) ? get_class($value) : gettype($value),
                'extra'         => ['cacheKey' => $cacheKey],
            ]
        );

        return $this->cacheRepository->set($cacheKey, $value, $ttl);
    }

    public function forever($key, $value): bool
    {
        $cacheKey = $this->getCacheKey($key);

        $this->logger->debug(
            'setting resource in cache forever',
            [
                'feature'       => FeatureList::CACHE,
                'resource.id'   => $key,
                'resource_type' => is_object($value) ? get_class($value) : gettype($value),
                'extra'         => ['cacheKey' => $cacheKey],
            ]
        );

        return $this->cacheRepository->forever($cacheKey, $value);
    }

    public function invalidate($key): bool
    {
        $cacheKey = $this->getCacheKey($key);

        $this->logger->debug(
            'removing resource from cache',
            [
                'feature'     => FeatureList::CACHE,
                'resource.id' => $key,
                'extra'       => ['cacheKey' => $cacheKey]
            ]
        );

        return $this->cacheRepository->delete($cacheKey);
    }

    public function clear(): bool
    {
        return $this->cacheRepository->clear();
    }

    public function has($key): bool
    {
        $cacheKey = $this->getCacheKey($key);

        return $this->cacheRepository->has($cacheKey);
    }

    public function findById(string $id): ?Model
    {
        if ($this->isCacheDisabled()) {
            return $this->eloquentRepository->findById($id);
        }

        $model = $this->get($id);
        if ($model instanceof Model) {
            return $model;
        }

        $model = $this->eloquentRepository->findById($id);
        if ($model instanceof Model) {
            $this->set($model->getId(), $model);
        }

        return $model;
    }

    public function create(array $attributes): Model
    {
        return $this->eloquentRepository->create($attributes);
    }

    public function update(Model $model, array $conditions, array $attributes): Model
    {
        $modelUpdated = $this->eloquentRepository->update($conditions, $attributes);
        if ($this->isCacheDisabled()) {
            return $this->findById($model->getId());
        }

        if ($modelUpdated) {
            $this->invalidate($model->getId());

            $model = $this->findById($model->getId());
            $this->set($model->getId(), $model);
        }

        return $model;
    }

    public function updateOrCreate(array $conditions, array $attributes): Model
    {
        $model = $this->eloquentRepository->updateOrCreate($conditions, $attributes);
        if ($model instanceof Model && $this->isCacheDisabled()) {
            return $this->findById($model->getId());
        }

        if ($model instanceof Model) {
            $this->invalidate($model->getId());

            $model = $this->findById($model->getId());
            $this->set($model->getId(), $model);
        }

        return $model;
    }

    public function hydrate(Collection $ids): Collection
    {
        return $ids->map(function (Model $model) {
            return $this->findById($model->getId());
        });
    }

    public function all(): Collection
    {
        $ids = $this->eloquentRepository->all();

        return $this->hydrate($ids);
    }

    public function where(array $conditions): Collection
    {
        $ids = $this->eloquentRepository->where($conditions, [ModelEntity::ID_COLUMN]);

        return $this->hydrate($ids);
    }

    private function isCacheDisabled(): bool
    {
        return config('baddi.cache.enabled') !== true;
    }

    private function isCacheEnabled(): bool
    {
        return ! $this->isCacheDisabled();
    }

    private function getCacheKey(string $suffix = null): string
    {
        $cacheKey = sprintf("%s", config('app.env'));

        if ($suffix !== null) {
            $cacheKey = sprintf("%s:%s", $cacheKey, sprintf(self::CACHE_KEY, $suffix));
        }

        return $cacheKey;
    }
}
