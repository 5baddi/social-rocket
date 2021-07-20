<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\OAuth;

use Throwable;
use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\AppLogger;
use Illuminate\Validation\ValidationException;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Http\Requests\ConnectStoreRequest;
use BADDIServices\ClnkGO\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\ClnkGO\Exceptions\Store\StoreAlreadyLinkedException;
use Illuminate\Support\Facades\Session;

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
            $storeName = $this->shopifyService->getStoreName($request->get('store'));

            if (is_null($storeName)) {
                throw new InvalidStoreURLException();
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