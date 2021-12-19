<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use BADDIServices\SocialRocket\App;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Services\SettingService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Repositories\StoreRepository;
use Illuminate\Support\Facades\Validator;

class StoreService extends Service
{
    /** @var StoreRepository */
    private $storeRepository;
    
    /** @var ShopifyService */
    private $shopifyService;

    /** @var UserService */
    private $userService;

    /** @var SettingService */
    private $settingService;

    public function __construct(
        StoreRepository $storeRepository, 
        ShopifyService $shopifyService, 
        UserService $userService,
        SettingService $settingService
    )
    {
        $this->storeRepository = $storeRepository;
        $this->shopifyService = $shopifyService;
        $this->userService = $userService;
        $this->settingService = $settingService;
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

        if (!$store instanceof Store) {
            return false;
        }

        $user = $this->userService->getStoreOwner($store);
        if (!$user instanceof User) {
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

        $attributes = Arr::only(
            $validator->validated(),
            [
                Store::NAME_COLUMN,
                Store::EMAIL_COLUMN,
                Store::DOMAIN_COLUMN,
                Store::SLUG_COLUMN,
                Store::PHONE_COLUMN,
                Store::COUNTRY_COLUMN,
                Store::SCRIPT_TAG_ID_COLUMN,
                Store::CONNECTED_AT_COLUMN,
                Store::ENABLED_COLUMN,
            ]
        );

        return $this->storeRepository->create($attributes);
    }
    
    public function update(Store $store, array $attributes): Store
    {
        $attributes = Arr::only(
            $attributes,
            [
                Store::NAME_COLUMN,
                Store::EMAIL_COLUMN,
                Store::DOMAIN_COLUMN,
                Store::SLUG_COLUMN,
                Store::PHONE_COLUMN,
                Store::COUNTRY_COLUMN,
                Store::SCRIPT_TAG_ID_COLUMN,
                Store::CONNECTED_AT_COLUMN,
                Store::ENABLED_COLUMN,
            ]
        );

        return $this->storeRepository->update($store, $attributes);
    }
    
    public function enableStore(Store $store): bool
    {
        return $this->storeRepository->update($store, [
            Store::ENABLED_COLUMN => true
        ]) !== false;
    }
    
    public function disableStore(Store $store): Store
    {
        return $this->storeRepository->update($store, [
            Store::ENABLED_COLUMN => false
        ]);
    }
    
    public function updateConfigurations(Store $store): Store
    {
        $configurations = collect($this->shopifyService->loadConfigurations($store));

        $attributes = $configurations->only([
            Store::NAME_COLUMN,
            Store::EMAIL_COLUMN,
            Store::DOMAIN_COLUMN,
            Store::PHONE_COLUMN,
            Store::COUNTRY_COLUMN,
        ]);

        Arr::set($attributes, Store::CONNECTED_AT_COLUMN, Carbon::now());

        return $this->storeRepository->update($store, $attributes->toArray());
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

    public function activeStores(): Collection
    {
        return $this->storeRepository->where([
            [Store::CONNECTED_AT_COLUMN, '!=', null]
        ]);
    }
    
    public function delete(Store $store): bool
    {
        return $this->storeRepository->delete($store->id);
    }

    public function getAllNewStoresCount(CarbonPeriod $period): int
    {
        return $this->storeRepository->countByPeriod(
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate()
        );
    }
    
    public function getAllNewActiveStoresCount(CarbonPeriod $period): int
    {
        return $this->storeRepository->countByPeriod(
            $period->copy()->getStartDate(),
            $period->copy()->getEndDate(),
            [
                [Store::CONNECTED_AT_COLUMN, '!=', null],
            ]
        );
    }

    public function iterateOnActiveStores(callable $callback, int $chunkSize = App::CHUNK_SIZE): bool
    {
        return $this->storeRepository->iterateOnActiveStores($callback, $chunkSize);
    }
}