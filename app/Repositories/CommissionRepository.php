<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Collection;

class CommissionRepository
{
    public function all(): Collection
    {
        return Commission::query()
                    ->all();
    }
    
    public function create(array $attributes): Commission
    {
        return Commission::query()
                    ->create($attributes);
    }
}