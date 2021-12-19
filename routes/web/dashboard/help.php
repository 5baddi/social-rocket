<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\HelpController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/help', HelpController::class)->name('.help');
    });