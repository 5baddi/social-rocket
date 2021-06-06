<?php

namespace App\Providers;

use BADDIServices\SocialRocket\Services\AppService;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultMorphKeyType('uuid');
        
        URL::forceScheme('https');

        /** @var AppService */
        $appService = app(AppService::class);
        $settings = $appService->settings();

        view()->composer('partials.admin.menu', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });
        
        view()->composer('partials.dashboard.menu', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });
        
        view()->composer('landing', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });
        
        view()->composer('privacy', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });
    }
}
