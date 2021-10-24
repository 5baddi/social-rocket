<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\OAuth;

use BADDIServices\SocialRocket\Common\Services\Shopify\MyShopService;
use BADDIServices\SocialRocket\Http\Requests\Oauth\ConnectShopRequest;
use Throwable;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\AppLogger;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService as OldShopifyService;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\SocialRocket\Exceptions\Store\StoreAlreadyLinkedException;
use Illuminate\Support\Facades\Session;

class OAuthController extends Controller
{
    /** @var OldShopifyService */
    private $shopifyService;

    /** @var MyShopService */
    private $myShopService;

    /** @var StoreService */
    private $storeService;

    public function __construct(
        OldShopifyService $shopifyService,
        MyShopService $myShopService,
        StoreService $storeService
    ) {
        parent::__construct();

        $this->shopifyService = $shopifyService;
        $this->myShopService = $myShopService;
        $this->storeService = $storeService;
    }

    public function __invoke(ConnectShopRequest $request)
    {
        try {
            $shopName = $this->myShopService->getShopName($request->get('shop'));
            dd($shopName);
            if (is_null($shopName)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Shop URL is invalid');
            }

            $storeIsLinked = $this->storeService->isLinked($storeName);
            if($storeIsLinked) {
                throw new StoreAlreadyLinkedException();
            }

            $store = $this->storeService->create([
                'slug'  =>  $storeName
            ]);

            $oauthURL = $this->shopifyService->getOAuthURL($store);

            Session::put('store', $store->id);

            return redirect($oauthURL);
        } catch (ValidationException $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:redirect-oauth', $request->all());

            return redirect()->back()->withInput()->withErrors($ex->errors());
        } catch (InvalidStoreURLException | StoreAlreadyLinkedException $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:redirect-oauth', $request->all());

            return redirect()->back()->withInput()->with("error", $ex->getMessage());
        } catch (Throwable $ex) {
            AppLogger::setStore($store ?? null)->error($ex, 'store:redirect-oauth', $request->all());

            return redirect()->back()->withInput()->with("error", "Internal server error");
        }
    }
}
