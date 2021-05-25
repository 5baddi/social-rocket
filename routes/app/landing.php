<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\LandingPageController;

Route::get('/', LandingPageController::class)->name('landing')->middleware(['signin.with.app']);

Route::redirect('/guide', '/', 301)->name('guide');
Route::redirect('/guide/affiliate/setup', env('GUIDE_SETUP', '/'), 301)->name('guide.affiliate.setup');
Route::redirect('/privacy.html', '/', 301)->name('privacy');
Route::redirect('/termsofservice.html', '/', 301)->name('termsofservice');
