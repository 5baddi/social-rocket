<?php

use BADDIServices\SocialRocket\Http\Controllers\DeleteCustomerController;

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

Route::name('webhooks')
    ->group(function() {
        Route::post('/customers/redact', DeleteCustomerController::class)->name('.customer.delete');
        Route::post('/shop/redact', DeleteStoreController::class)->name('.store.delete');
        Route::post('/customers/data_request', ShowCustomerController::class)->name('.customer.show');
    });