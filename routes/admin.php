<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

Route::name('admin')
    ->prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        require 'admin/stats.php';
        require 'admin/stores.php';
        require 'admin/users.php';
        require 'admin/settings.php';

        Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('.logs');
    });