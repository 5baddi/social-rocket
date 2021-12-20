<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Plan\UpgradePlanController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\CancelSubscriptionController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard.plan')
    ->prefix('dashboard/plan')
    ->group(function() {
        Route::get('/', function() {
            return redirect()->route('dashboard.account', ['tab' => 'plan']);
        });

        Route::get('/upgrade', UpgradePlanController::class)->name('.upgrade');
        Route::get('/cancel', CancelSubscriptionController::class)->name('.cancel');
    });