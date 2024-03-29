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

            if ($slug !== null) {
                $store = $this->storeService->findBySlug($slug);

                if (!$store instanceof Store) {
                    $store = $this->storeService->create([
                        'slug'  =>  $slug
                    ]);
                }

                try {
                    $this->shopifyService->verifySignature($request->query());

                    $storeOwner = $this->userService->getStoreOwner($store);
                    if ($store->oauth instanceof OAuth && $storeOwner instanceof User) {
                        $authenticateUser = Auth::loginUsingId($storeOwner->id);
                        if ($authenticateUser) {
                            $this->userService->update($storeOwner, [
                                User::LAST_LOGIN_COLUMN    =>  Carbon::now()
                            ]);
    
                            return redirect()->route('dashboard')->with('success', 'Welcome back ' . strtoupper($storeOwner->getFullName()));    
                        }
                    }

                    return redirect()
                        ->route('fast.connect', ['store' => $store->slug]);
                } catch (InvalidRequestSignatureException $ex) {
                    AppLogger::setStore($store)
                    ->error(
                        $ex, 'store:login-via-app', 
                        [
                            'playload' => $request->query()
                    ]
                    );
                }
            }
        }

        return $next($request);
    }
}
