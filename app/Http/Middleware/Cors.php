<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use Symfony\Component\HttpFoundation\Response;

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
        $origin = $request->server('HTTP_REFERER') ?? $request->server('HTTP_ORIGIN');
        $originSlug = $this->shopifyService->getStoreName($origin);
        $slug = $this->shopifyService->getStoreName($request->query('shop'));
        if (is_null($originSlug) || is_null($slug) || $originSlug !== $slug) {
            abort(Response::HTTP_FORBIDDEN, 'Forbidden');
        }
        
        $store = $this->storeService->findBySlug($originSlug);

        if (!$store instanceof Store) {
            abort(Response::HTTP_FORBIDDEN, 'Forbidden');
        }

        $request->merge(['slug' => $originSlug]);

        return $next($request);
    }
}
