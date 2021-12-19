<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings\SettingsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings\UpdateSettingsController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/settings', SettingsController::class)->name('.settings');
        Route::post('/settings', UpdateSettingsController::class)->name('.settings.save');
    });