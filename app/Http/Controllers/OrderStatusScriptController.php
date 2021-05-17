<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\CouponService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class OrderStatusScriptController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;
    
    /** @var StoreService */
    private $storeService;

    /** @var CouponService */
    private $couponService;

    public function __construct(ShopifyService $shopifyService, StoreService $storeService, CouponService $couponService)
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
        $this->couponService = $couponService;
    }
    
    public function __invoke(Request $request)
    {
        try {
            $storeName = $this->shopifyService->getStoreName($request->query('shop'));
            if (is_null($storeName)) {
                return '';
            }

            $store = $this->storeService->findBySlug($storeName);
            if (!$store instanceof Store) {
                return '';
            }

            $store->load('setting');

            /** @var Setting */
            $setting = $store->setting;
            if (!$setting instanceof Setting) {
                $setting = new StoreSetting();
            }

            return view('script', [
                'html'      =>  $this->couponService->getScriptTag($store->coupon, $setting->discount_amount, $setting->discount_type, $setting->currency, $setting->color)
            ]);
        } catch (Throwable $ex) {
            return $ex->getMessage();
            return response('', Response::HTTP_NO_CONTENT);
        }
    }
}