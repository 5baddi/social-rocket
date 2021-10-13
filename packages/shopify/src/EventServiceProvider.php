<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify;

use BADDIServices\Packages\Shopify\Events\ShopConnected;
use BADDIServices\Packages\Shopify\Listeners\RegisterScriptTag;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ShopConnected::class => [
            RegisterScriptTag::class
        ]
    ];

    public function boot()
    {
        parent::boot();
    }
}
