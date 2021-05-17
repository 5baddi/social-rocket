<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AffiliateController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User */
    protected $user;

    /** @var StoreService */
    protected $storeService;
    
    /** @var ShopifyService */
    protected $shopifyService;

    public function __construct(StoreService $storeService, ShopifyService $shopifyService)
    {
        $this->middleware(function ($request, $next) use ($storeService, $shopifyService){
            $this->user = Auth::user();

            return $next($request);
        });

        $this->storeService = $storeService;
        $this->shopifyService = $shopifyService;
    }
}