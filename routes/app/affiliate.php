<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\OrderStatusScriptController;
use BADDIServices\SocialRocket\Http\Controllers\Affiliate\Dashboard\AnalyticsController;
use BADDIServices\SocialRocket\Http\Controllers\Affiliate\Inscription\CreateAccountController;
use BADDIServices\SocialRocket\Http\Controllers\Affiliate\Inscription\SignUpController as AffiliateSignUpController;

Route::name('affiliate')
    ->prefix('affiliate')
    ->group(function() {
        Route::redirect('/', '/', 301);

        Route::get('/{store}', AffiliateSignUpController::class);
        Route::post('/{store}/signup', CreateAccountController::class)->name('.signup');

        Route::middleware(['auth', 'is.affiliate'])
            ->group(function() {
                Route::get('/analytics', AnalyticsController::class)->name('.analytics');
            });
    });

Route::middleware(['cors'])->group(function() {
    Route::get('/order_status.js', OrderStatusScriptController::class);
});