<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\ViewStoreController;
use BADDIServices\SocialRocket\Http\Controllers\Admin\Stores as Stores;

Route::middleware(['auth', 'admin'])
    ->prefix('admin/stores')
    ->name('admin.stores')
    ->group(function() {
        Route::get('/', Stores\IndexController::class);
        Route::post('/{store}/enable', Stores\EnableStoreController::class)->name('.enable');
        Route::post('/{store}/disable', Stores\DisableStoreController::class)->name('.disable');
        Route::get('/{store}/view', ViewStoreController::class)->name('.view');
    });