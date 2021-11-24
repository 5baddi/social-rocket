<?php

namespace App\Providers;

use BADDIServices\SocialRocket\Common\Providers\ShopOwnerProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('shop-owner', function($app, array $config) {
            return new ShopOwnerProvider($app['hash'], $config['model']);
        });
    }
}
