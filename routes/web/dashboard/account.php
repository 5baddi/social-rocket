<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts\PayoutsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts\SendPayoutController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/payouts', PayoutsController::class)->name('.payouts');
        Route::post('/payouts/{commission}', SendPayoutController::class)->name('.payouts.send');
    });