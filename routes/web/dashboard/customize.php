<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\CustomizeController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\IntegrationsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\Mails\PurchaseMailController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\UpdateIntegrationsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\SaveCustomizeSettingController;
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/customize', CustomizeController::class)->name('.customize');
        Route::post('/customize', SaveCustomizeSettingController::class)->name('.customize.save');
        Route::get('/customize/integrations', IntegrationsController::class)->name('.customize.integrations');
        Route::post('/customize/integrations', UpdateIntegrationsController::class)->name('.customize.integrations.save');
        Route::prefix('customize/integrations')
            ->name('.customize.integrations')
            ->group(function() {
                Route::get('/mails/purchase', PurchaseMailController::class)->name('.mails.purchase');
            });
    });