<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\Shopify\ShopifyService;

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
        $shopDomain = $request->header('HTTP_X-SHOPIFY-SHOP-DOMAIN');

        if (!is_null($hmacHeader)) {
            if ($this->shopifyService->verifySignature($request->query())) {
                // TODO: verify shop exists and not disabled
                return $next($request);
            }
        }

        $this->logger->info('Unauthrozied webhook request', 'webhooks:shopify-unauthorized', ['playload' => $request->all()]);
        abort(Response::HTTP_UNAUTHORIZED);
    }
}