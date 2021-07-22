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

class DisableStoreController extends ControllersAdminController
{
    public function __invoke(Store $store)
    {
        $this->storeService->disableStore($store);

        return redirect()
                ->back()
                ->with(
                    'alert',
                    new Alert('Store disabled successfully', 'success')
                );
    }
}