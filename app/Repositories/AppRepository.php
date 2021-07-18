<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\AppSetting;

class AppRepository
{
    public function first(): ?AppSetting
    {
        return AppSetting::query()
                    ->first();
    }
    
    public function update(array $attributes): bool
    {
        return AppSetting::query()
                    ->update($attributes) > 0;
    }
}