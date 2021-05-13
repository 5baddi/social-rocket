<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Http\Requests\OAuthCallbackRequest;
use BADDIServices\SocialRocket\Models\Store;

class OAuthCallbackController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var StoreService */
    private $storeService;

    public function __construct(ShopifyService $shopifyService, StoreService $storeService)
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
    }
    
    public function __invoke(OAuthCallbackRequest $request)
    {
        $storeName = $this->shopifyService->getStoreName($request->query('shop'));

        $store = $this->storeService->findBySlug($storeName);
        abort_unless($store instanceof Store, 'Store not found');

        $accessToken = $this->shopifyService->getStoreAccessToken($request->query());
        $attributes = $request->merge($accessToken)->all();
        $oauth = $this->storeService->updateStoreOAuth($store, $attributes);
        dd($oauth);
    }
}
