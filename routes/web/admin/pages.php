<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Admin\Pages as Pages;

Route::middleware(['auth', 'admin'])
    ->prefix('admin/pages')
    ->name('admin.pages')
    ->group(function() {
        Route::get('/', Pages\IndexController::class);
    });