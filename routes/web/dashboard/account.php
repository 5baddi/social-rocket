<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\AccountController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\UpdateAccountController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard.account')
    ->prefix('dashboard/account')
    ->group(function() {
        Route::get('/', AccountController::class);
        Route::post('/', UpdateAccountController::class)->name('.account.save');
    });