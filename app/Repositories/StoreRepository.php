<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Models\Store;

class StoreRepository
{
    public function all(): Collection
    {
        return Store::query()
                    ->with(['subscription'])
                    ->get();
    }
    
    public function findById(string $id): ?Store
    {
        return Store::query()
                    ->find($id);
    }

    public function findBySlug(string $slug): ?Store
    {
        return Store::query()
                    ->with(['user'])
                    ->where([
                        Store::SLUG_COLUMN => $slug
                    ])
                    ->first();
    }
    
    public function first(array $conditions): ?Store
    {
        return Store::query()
                    ->where($conditions)
                    ->first();
    }
    
    public function where(array $conditions): Collection
    {
        return Store::query()
                    ->where($conditions)
                    ->get();
    }
    
    public function isLinked(string $slug): ?Store
    {
        return Store::query()
                    ->where([
                        Store::SLUG_COLUMN => $slug
                    ])
                    ->whereNotNull(Store::CONNECTED_AT_COLUMN)
                    ->first();
    }
    
    public function create(array $attributes): Store
    {
        return Store::query()
                    ->updateOrCreate(
                        [
                            Store::SLUG_COLUMN => Arr::get($attributes, Store::SLUG_COLUMN)
                        ], 
                        $attributes
                    );
    }
    
    /**
     * @return Store|false
     */
    public function update(Store $store, array $attributes)
    {
        $storeUpdated = Store::query()
                            ->where(
                                [
                                    Store::ID_COLUMN => $store->id
                                ]
                            )
                            ->update($attributes);

        if ($storeUpdated) {
            return $store->refresh();
        }

        return false;
    }
    
    public function oauth(string $storeId, array $attributes): OAuth
    {
        Arr::set($attributes, OAuth::STORE_ID_COLUMN, $storeId);
        
        return OAuth::query()
                    ->updateOrCreate(
                        [
                            OAuth::STORE_ID_COLUMN  =>  $storeId
                        ], 
                        $attributes
                    );
    }

    public function delete(string $id): bool
    {
        return Store::query()
                    ->find($id)
                    ->delete();
    }

    public function countByPeriod(Carbon $startDate, carbon $endDate, array $conditions = []): int
    {
        return Store::query()
                    ->whereDate(
                        Store::CREATED_AT,
                        '>=',
                        $startDate
                    )
                    ->whereDate(
                        Store::CREATED_AT,
                        '<=',
                        $endDate
                    )
                    ->where($conditions)
                    ->count();
    }

    public function iterateOnActiveStores(callable $callback, int $chunkSize): bool
    {
        return Store::query()
            ->where(Store::ENABLED_COLUMN, true)
            ->whereNotNull(Store::CONNECTED_AT_COLUMN)
            ->chunk($chunkSize, $callback);
    }
}