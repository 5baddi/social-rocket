<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\ClnkGO\Http\Controllers\Webhooks as Webhooks;

Route::name('webhooks')
    ->prefix('webhooks')
    ->middleware(['guest', 'is-shopify-webhook'])
    ->group(function() {
        Route::post('/order/updated', Webhooks\UpdateOrderController::class)->name('.order.updated');
        Route::post('/customers/data_request', Webhooks\ShowCustomerController::class)->name('.customer.show');
        Route::post('/customers/redact', Webhooks\DeleteCustomerController::class)->name('.customer.delete');
        Route::post('/shop/redact', Webhooks\DeleteStoreController::class)->name('.store.delete');
    });