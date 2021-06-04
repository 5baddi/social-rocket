<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

Route::name('admin')
    ->prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        require 'admin/stats.php';
        require 'admin/users.php';
        require 'admin/settings.php';
        require 'admin/webhooks.php';
    });