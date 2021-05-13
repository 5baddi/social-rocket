<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Http\Requests\ConnectStoreRequest;
use BADDIServices\SocialRocket\Services\StoreService;

class OAuthController extends Controller
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
    
    public function __invoke(ConnectStoreRequest $request)
    {
        $storeName = $this->shopifyService->getStoreName($request->query('store'));
        $oauthURL = $this->shopifyService->getOAuthURL($storeName);

        $this->storeService->createStore([
            'slug'  =>  $storeName
        ]);

        return redirect($oauthURL);
    }
}