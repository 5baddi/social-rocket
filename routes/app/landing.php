<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\ClnkGO\Http\Controllers\LandingPageController;

Route::get('/', LandingPageController::class)->name('landing')->middleware(['signin.with.app']);

Route::redirect('/guide', '/', 301)->name('guide');
Route::redirect('/guide/affiliate/setup', config('clnkgo.guide_setup', '/'), 301)->name('guide.affiliate.setup');
Route::get('/privacy.html', [LandingPageController::class, 'privacy'])->name('privacy');
Route::redirect('/termsofservice.html', '/', 301)->name('termsofservice');
