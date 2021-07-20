<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'cors'
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                  => \App\Http\Middleware\Authenticate::class,
        'auth.basic'            => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers'         => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                   => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                 => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm'      => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed'                => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'              => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'              => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'has.store'             => \BADDIServices\ClnkGO\Http\Middleware\HasStore::class,
        'has.subscription'      => \BADDIServices\ClnkGO\Http\Middleware\HasSubscription::class,
        'cors'                  => \BADDIServices\ClnkGO\Http\Middleware\Cors::class,
        'is.affiliate'          => \BADDIServices\ClnkGO\Http\Middleware\AffiliateAccount::class,
        'store-owner'           => \BADDIServices\ClnkGO\Http\Middleware\StoreOwner::class,
        'admin'                 => \BADDIServices\ClnkGO\Http\Middleware\SuperAdmin::class,
        'signin.with.app'       => \BADDIServices\ClnkGO\Http\Middleware\SignInWithShopifyApp::class,
        'is-shopify-webhook'    => \BADDIServices\ClnkGO\Http\Middleware\IsShopifyWebhook::class,
    ];

    protected function bootstrappers()
    {
        return array_merge(
            [\Bugsnag\BugsnagLaravel\OomBootstrapper::class],
            parent::bootstrappers(),
        );
    }
}
