<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Stores;

use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;
use BADDIServices\SocialRocket\Models\Store;

class EnableStoreController extends ControllersAdminController
{
    /** @var StoreService */
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        parent::__construct();
        
        $this->storeService = $storeService;
    }

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