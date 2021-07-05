<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\AppLogger;
use Illuminate\Support\Facades\Validator;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Exceptions\Shopify\InvalidRequestSignatureException;
use BADDIServices\SocialRocket\Models\OAuth;

class SignInWithShopifyApp
{
    /** @var ShopifyService */
    private $shopifyService;
    
    /** @var StoreService */
    private $storeService;
    
    /** @var UserService */
    private $userService;

    public function __construct(ShopifyService $shopifyService, StoreService $storeService, UserService $userService)
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
        $this->userService = $userService;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->query(), [
            'shop'          =>  ['required', 'string'],
            'hmac'          =>  ['required', 'string'],
            'timestamp'     =>  ['required', 'integer'],
        ]);

        if (!$validator->fails()) {
            $shop = $request->query('shop');
            $slug = $this->shopifyService->getStoreName($shop);

            if (!is_null($slug)) {
                $store = $this->storeService->findBySlug($slug);

                if ($store instanceof Store) {
                    try {
                        $this->shopifyService->verifySignature($request->query());

                        if (!$store->oauth instanceof OAuth) {
                            return redirect()->route('oauth.connect', ['store' => $store->slug]);
                        }

                        $storeOwner = $this->userService->getStoreOwner($store);
                        if (!$storeOwner->user instanceof User) {
                            return redirect()->route('landing');
                        }

                        $authenticateUser = Auth::loginUsingId($storeOwner->id);
                        if (!$authenticateUser) {
                            return redirect()->route('landing');
                        }

                        $this->userService->update($storeOwner, [
                            User::LAST_LOGIN_COLUMN    =>  Carbon::now()
                        ]);

                        return redirect()->route('dashboard')->with('success', 'Welcome back ' . strtoupper($storeOwner->getFullName()));
                    } catch (InvalidRequestSignatureException $ex) {
                        AppLogger::setStore($store)->error($ex, 'store:login-via-app', ['playload' => $request->all()]);
                    }
                }
            }
        }

        return $next($request);
    }
}
