<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Support\Arr;

class StoreRepository
{
    public function findBySlug(string $slug): ?Store
    {
        return Store::query()
                    ->where([
                        Store::SLUG_COLUMN => $slug
                    ])
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
    
    public function oauth(string $storeId, array $attributes): OAuth
    {
        return OAuth::query()
                    ->updateOrCreate(
                        [
                            OAuth::STORE_ID  =>  $storeId
                        ], 
                        $attributes
                    );
    }
}
    