<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\OAuthController;
use BADDIServices\SocialRocket\Http\Controllers\OAuthCallbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('connect', OAuthController::class)->name('oauth.connect');
Route::get('oauth/callback', OAuthCallbackController::class)->name('oauth.callback');