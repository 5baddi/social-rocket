<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Repositories\StoreRepository;

class StoreService extends Service
{
    /** @var StoreRepository */
    private $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function all(): Collection
    {
        return $this->storeRepository->all();
    }
    
    public function findById(string $id): ?Store
    {
        return $this->storeRepository->findById($id);
    }
    
    public function findBySlug(string $slug): ?Store
    {
        return $this->storeRepository->findBySlug($slug);
    }
    
    public function isLinked(string $slug): bool
    {
        $store = $this->storeRepository->isLinked($slug);

        if(!$store instanceof Store) {
            return false;
        }

        return true;
    }
    
    public function create(array $attributes): Store
    {
        $validator = Validator::make($attributes, [
            'slug'      =>  'required|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->storeRepository->create($attributes);
    }
    
    public function update(Store $store, array $attributes): Store
    {
        return $this->storeRepository->update($store, $attributes);
    }
    
    public function updateStoreOAuth(Store $store, array $attributes): OAuth
    {
        $validator = Validator::make($attributes, [
            'code'              =>  'required|string',
            'access_token'      =>  'required|string',
            'scope'             =>  'required|string',
            'timestamp'         =>  'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->storeRepository->oauth($store->id, $attributes);
    }
}