<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\OAuth;

use Throwable;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Http\Requests\ConnectStoreRequest;
use BADDIServices\ClnkGO\Exceptions\Shopify\InvalidStoreURLException;
use BADDIServices\ClnkGO\Exceptions\Store\StoreAlreadyLinkedException;
use Illuminate\Support\Facades\Session;

class OAuthController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
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
            $this->logger->setStore($store ?? null)->error($ex, 'store:redirect-oauth', $request->all());
            
            return redirect()->back()->withInput()->withErrors($ex->errors());
        } catch (InvalidStoreURLException | StoreAlreadyLinkedException $ex) {
            $this->logger->setStore($store ?? null)->error($ex, 'store:redirect-oauth', $request->all());

            return redirect()->back()->withInput()->with("error", $ex->getMessage());
        } catch (Throwable $ex) {
            $this->logger->setStore($store ?? null)->error($ex, 'store:redirect-oauth', $request->all());

            return redirect()->back()->withInput()->with("error", "Internal server error");
        }
    }
}