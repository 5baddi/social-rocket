<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Http\Requests\ConnectStoreRequest;
use BADDIServices\SocialRocket\Services\StoreService;
use Exception;
use Illuminate\Validation\ValidationException;

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
        try {
            $storeName = $this->shopifyService->getStoreName($request->input('store'));
            if (is_null($storeName)) {
                throw new InvalidStoreURLException();
            }

            $oauthURL = $this->shopifyService->getOAuthURL($storeName);

            $this->storeService->createStore([
                'slug'  =>  $storeName
            ]);

            session('slug', $storeName);

            return redirect($oauthURL);
        } catch (ValidationException $ex) {
            return redirect()->back()->withInput()->withErrors($ex->errors());
        } catch (InvalidStoreURLException $ex) {
            return redirect()->back()->withInput()->withErrors($ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->back()->withInput()->withErrors("Internal server error");
        }
    }
}