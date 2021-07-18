<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository
{
    public function all(): Collection
    {
        return Setting::query()
                    ->get();
    }
    
    public function findById(string $id): ?Setting
    {
        return Setting::query()
                    ->find($id);
    }
    
    public function save(string $storeId, array $attributes): Setting
    {
        $attributes = array_merge($attributes, [
            Setting::STORE_ID_COLUMN   => $storeId
        ]);

        return Setting::query()
                    ->updateOrCreate(
                        [
                            Setting::STORE_ID_COLUMN   => $storeId,
                        ],
                        $attributes
                    );
    }
}