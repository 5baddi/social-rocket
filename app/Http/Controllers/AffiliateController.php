<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\ClnkGO\Services\Shopify\ShopifyService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AffiliateController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /** @var ShopifyService */
    protected $shopifyService;

    public function __construct()
    {
        parent::__construct();

        /** @var ShopifyService */
        $this->shopifyService = app(ShopifyService::class);
    }
}