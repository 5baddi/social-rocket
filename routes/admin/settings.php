<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\Admin\Settings as Settings;

Route::get('/settings', Settings\IndexController::class)->name('.settings');