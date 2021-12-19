<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\ViewStoreController;
use BADDIServices\SocialRocket\Http\Controllers\Admin\Stores as Stores;

Route::prefix('stores')
    ->name('.stores')
    ->group(function() {
        Route::get('/', Stores\IndexController::class);
        Route::post('/{store}/enable', Stores\EnableStoreController::class)->name('.enable');
        Route::post('/{store}/disable', Stores\DisableStoreController::class)->name('.disable');
        Route::get('/{store}/view', ViewStoreController::class)->name('.view');
    });