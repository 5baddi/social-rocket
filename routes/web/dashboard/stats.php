<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\IndexController;

Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/', IndexController::class)->name('dashboard');
        Route::post('/', IndexController::class)->name('dashboard.filtered');
    });