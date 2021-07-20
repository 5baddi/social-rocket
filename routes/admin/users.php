<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\ClnkGO\Http\Controllers\Admin\Users as Users;


Route::prefix('accounts')
    ->name('.users')
    ->group(function() {
        Route::get('/', Users\IndexController::class);
        Route::post('/{user}/ban', Users\BanController::class)->name('.ban');
        Route::post('/{user}/password/reset', Users\ResetPasswordController::class)->name('.password.reset');
    });