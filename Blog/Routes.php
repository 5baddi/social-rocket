<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Blog\Controllers as Blog;

Route::name('blog')
    ->prefix('blog')
    ->middleware(['guest'])
    ->group(function() {
        Route::get('/', Blog\IndexController::class)->name('.index');
    });