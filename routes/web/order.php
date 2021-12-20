<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\OrderStatusScriptController;

Route::middleware(['cors'])->group(function() {
    Route::get('/order_status.js', OrderStatusScriptController::class);
});