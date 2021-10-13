<?php

namespace App\Providers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use BADDIServices\SocialRocket\Models\AppSetting;
use BADDIServices\SocialRocket\Services\AppService;

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

        Schema::defaultStringLength(191);

        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        $settings = new AppSetting();
        try {
            if (Schema::hasTable(AppSetting::TABLE)) {
                /** @var AppService */
                $appService = app(AppService::class);
                $settings = $appService->settings();
            }
        } catch (QueryException $e) {}


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
