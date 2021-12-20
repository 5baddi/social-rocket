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
    ->name('dashboard.payouts')
    ->prefix('dashboard/payouts')
    ->group(function() {
        Route::get('/', PayoutsController::class);
        Route::post('/{commission}', SendPayoutController::class)->name('.send');
    });