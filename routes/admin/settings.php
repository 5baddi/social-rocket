<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\ClnkGO\Http\Controllers\Admin\Settings as Settings;


Route::prefix('settings')
    ->name('.settings')
    ->group(function() {
        Route::get('/', Settings\IndexController::class);
        Route::post('/', Settings\UpdateSettingsController::class)->name('.update');
    });