<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('apilogger')
    ->group(function() {
        require 'app/landing.php';
        require 'app/guest.php';
        require 'app/affiliate.php';
        require 'app/storeOwner.php';
        require 'admin.php';
        require 'webhooks.php';
    });