<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Admin\Stats as Stats;

Route::middleware(['auth', 'admin'])
    ->get('/admin', Stats\IndexController::class)
    ->name('admin');