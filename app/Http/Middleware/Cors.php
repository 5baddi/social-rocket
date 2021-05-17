<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;

class Cors
{
    /** @var ShopifyService */
    private $shopifyService;
    
    /** @var StoreService */
    private $storeService;

    public function __construct(ShopifyService $shopifyService, storeService $storeService)
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
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
        $origin = $request->server('HTTP_ORIGIN');
        $slug = $this->shopifyService->getStoreName($origin);
        dd($slug);
        $store = $this->storeService->findBySlug($slug);

        if ($store instanceof Store) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type');
        }

        return $next($request);
    }
}
