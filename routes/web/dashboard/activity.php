<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityMarkAsReadController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityMarkAllAsReadController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/activity', ActivityController::class)->name('.activity');
        Route::get('/activity/read', ActivityMarkAllAsReadController::class)->name('.activity.read.all');
        Route::get('/activity/{notification}', ActivityMarkAsReadController::class)->name('.activity.read');
    });