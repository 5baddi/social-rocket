<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Services\Shopify\ShopifyService;

class ViewStoreController extends Controller
{
    /** @var ShopifyService */
    protected $shopifyService;

    public function __construct( ShopifyService $shopifyService)
    {
        parent::__construct();

        $this->shopifyService = $shopifyService;
    }

    public function __invoke(Store $store)
    {
        return redirect(
            $this->shopifyService->getStoreURL($store->slug)
        );
    }
}