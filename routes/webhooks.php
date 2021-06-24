<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\Webhooks\DeleteStoreController;
use BADDIServices\SocialRocket\Http\Controllers\Webhooks\ShowCustomerController;

Route::name('webhooks')
    ->prefix('webhooks')
    ->middleware(['guest', 'is-shopify-webhook'])
    ->group(function() {
        Route::post('/customers/data_request', ShowCustomerController::class)->name('.customer.show');
        Route::post('/customers/redact', DeleteCustomerController::class)->name('.customer.delete');
        Route::post('/shop/redact', DeleteStoreController::class)->name('.store.delete');
    });