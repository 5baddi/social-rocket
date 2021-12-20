<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Preview\CheckoutPreviewController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard.preview')
    ->prefix('dashboard/preview')
    ->group(function() {
        Route::get('/checkout', CheckoutPreviewController::class)->name('.checkout');
    });