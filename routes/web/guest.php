<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignInController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignUpController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\ConnectController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignOutController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\CreateUserController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\AuthenticateController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthCallbackController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\ResetPassword as ResetPassword;

Route::middleware('guest')
    ->group(function() {
        Route::get('/connect', ConnectController::class)->name('connect');
        Route::get('/fast/connect', OAuthController::class)->name('fast.connect');
        Route::post('/connect', OAuthController::class)->name('oauth.connect');
        Route::get('/oauth/callback', OAuthCallbackController::class)->name('oauth.callback');

        Route::get('/signup/{store}', SignUpController::class)->middleware(['has.store'])->name('signup');
        Route::post('/auth/signup/{store}', CreateUserController::class)->middleware(['has.store'])->name('auth.signup');
        Route::get('/signin', SignInController::class)->name('signin');
        Route::post('/auth/signin', AuthenticateController::class)->name('auth.signin');

        Route::get('/reset', ResetPassword\IndexController::class)->name('reset');
        Route::post('/auth/token', ResetPassword\SendResetTokenController::class)->name('auth.reset.token');
        Route::get('/reset/{token}', ResetPassword\EditController::class)->name('password');
        Route::post('/auth/password', ResetPassword\ResetPasswordController::class)->name('auth.reset.password');
    });

Route::middleware(['auth'])
    ->group(function() {
        Route::get('/logout', SignOutController::class)->name('signout');
    });
