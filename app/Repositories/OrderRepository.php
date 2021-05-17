<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\Order;

class OrderRepository
{
    public function latest(): Order
    {
        return Order::query()
                    ->latest()
                    ->first();
    }
    
    public function save(array $attributes, array $values): Order
    {
        return Order::query()
                    ->updateOrCreate(
                        $attributes,
                        $values
                    );
    }
}