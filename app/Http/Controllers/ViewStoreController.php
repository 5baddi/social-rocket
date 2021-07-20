<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\ClnkGO\Services\ShopifyService;

class ViewStoreController extends BaseController
{
    /** @var ShopifyService */
    protected $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    public function __invoke(Store $store)
    {
        return redirect(
            $this->shopifyService->getStoreURL($store->slug)
        );
    }
}