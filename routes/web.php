<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignInController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignUpController;
use BADDIServices\SocialRocket\Http\Controllers\LandingPageController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\ConnectController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignOutController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\CreateUserController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\AuthenticateController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthCallbackController;
use BADDIServices\SocialRocket\Http\Controllers\Payment\StripePaymentController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\BillingPayController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', LandingPageController::class);
Route::redirect('/guide', '/', 301)->name('guide');

Route::middleware('guest')
    ->group(function() {
        Route::get('/connect', ConnectController::class)->middleware(['has.store', 'app.connected'])->name('connect');
        Route::post('/connect', OAuthController::class)->name('oauth.connect');
        Route::get('/oauth/callback', OAuthCallbackController::class)->name('oauth.callback');

        Route::get('/signup', SignUpController::class)->middleware(['has.store', 'app.notconnected'])->name('signup');
        Route::post('/auth/signup', CreateUserController::class)->name('auth.signup');
        Route::get('/signin', SignInController::class)->name('signin');
        Route::post('/auth/signin', AuthenticateController::class)->name('auth.signin');
    });

Route::middleware(['auth', 'has.subscription'])
    ->name('subscription')
    ->prefix('subscription')
    ->group(function() {
        Route::get('/', SubscriptionController::class)->name('.select.pack');
        Route::get('/billing/{pack}', BillingPayController::class)->name('.pack.billing');
        Route::post('/pay/{pack}', StripePaymentController::class)->name('.pay');
    });

Route::middleware(['auth', 'has.subscription'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/', function() {
            dd("Implement subscription..");
        });

        Route::get('/logout', SignOutController::class)->name('.signout');
    });