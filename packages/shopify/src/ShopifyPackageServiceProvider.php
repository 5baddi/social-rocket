<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify;

use Illuminate\Support\ServiceProvider;

class ShopifyPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->app->register(EventServiceProvider::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/shopify.php', 'shopify');
    }
}
