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
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/plan', function() {
            return redirect()->route('dashboard.account', ['tab' => 'plan']);
        })->name('.plan');

        Route::get('/plan/upgrade', UpgradePlanController::class)->name('.plan.upgrade');
        Route::get('/plan/cancel', CancelSubscriptionController::class)->name('.plan.cancel');
    });