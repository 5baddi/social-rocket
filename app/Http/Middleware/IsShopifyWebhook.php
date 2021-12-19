<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use BADDIServices\SocialRocket\AppLogger;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\ShopifyService;

class IsShopifyWebhook
{
    /** @var ShopifyService */
    private $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
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
        $hmacHeader = $request->header('HTTP_X_SHOPIFY_HMAC_SHA256');

        if (!is_null($hmacHeader)) {
            if ($this->shopifyService->verifySignature($request->query())) {
                return $next($request);
            }
        }

        AppLogger::info('Unauthrozied webhook request', 'webhooks:shopify-unauthorized', ['playload' => $request->all()]);
        abort(Response::HTTP_UNAUTHORIZED);
    }
}