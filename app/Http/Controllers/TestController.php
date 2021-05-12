<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\ShopifyService;

class TestController extends Controller
{
    private $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    public function __invoke(Request $request)
    {
        dd($this->shopifyService->getOAuthURL('https://badstoredevtest.myshopify.com/'));
    }
}