<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Pack;
use Illuminate\Database\Eloquent\Collection;

class PackRepository
{
    public function all(): Collection
    {
        return Pack::query()
                    ->get();
    }
    
    public function findById(string $id): ?Pack
    {
        return Pack::query()
                    ->find($id);
    }
}