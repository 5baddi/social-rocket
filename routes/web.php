<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignUpController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\ConnectController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\CreateUserController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\SubscriptionController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthCallbackController;

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

Route::redirect('/', '/connect', 301);

Route::get('/connect', ConnectController::class)->name('connect');
Route::post('/connect', OAuthController::class)->name('oauth.connect');
Route::get('/oauth/callback', OAuthCallbackController::class)->name('oauth.callback');

Route::get('/signup', SignUpController::class)->name('signup');
Route::post('/auth/signup', CreateUserController::class)->name('auth.signup');
Route::get('/signin', SignInController::class)->name('signin');
Route::post('/signin', AuthenticateController::class)->name('auth.signin');

Route::middleware('auth')
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/subscription', SubscriptionController::class)->name('.select.pack');
    });