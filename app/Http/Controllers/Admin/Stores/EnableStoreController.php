<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Admin\Stores;

use BADDIServices\ClnkGO\Entities\Alert;
use BADDIServices\ClnkGO\Http\Controllers\AdminController as ControllersAdminController;
use BADDIServices\ClnkGO\Models\Store;

class EnableStoreController extends ControllersAdminController
{
    public function __invoke(Store $store)
    {
        $this->storeService->enableStore($store);

        return redirect()
                ->back()
                ->with(
                    'alert',
                    new Alert('Store enabled successfully', 'success')
                );
    }
}