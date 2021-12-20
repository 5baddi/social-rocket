<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\HelpController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard.help')
    ->prefix('dashboard/help')
    ->group(function() {
        Route::get('/', HelpController::class);
    });