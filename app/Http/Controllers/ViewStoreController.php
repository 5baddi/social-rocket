<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\SocialRocket\Services\ShopifyService;

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