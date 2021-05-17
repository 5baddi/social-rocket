<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function first(): ?Product
    {
        return Product::query()
                    ->first();
    }
    
    public function where(array $attributes): Collection
    {
        return Product::query()
                    ->where($attributes)
                    ->get();
    }
    
    public function create(array $attributes): Product
    {
        return Product::query()
                    ->create($attributes);
    }
}