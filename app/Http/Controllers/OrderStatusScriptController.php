<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Setting;
use BADDIServices\ClnkGO\Entities\StoreSetting;
use BADDIServices\ClnkGO\AppLogger;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\CouponService;
use BADDIServices\ClnkGO\Services\ShopifyService;
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
            $store = $this->storeService->findBySlug($request->query('slug'));
            if (!$store instanceof Store) {
                return '';
            }

            $store->load('setting');

            /** @var Setting */
            $setting = $store->setting;
            if (!$setting instanceof Setting) {
                $setting = new StoreSetting();
            }

            if (!$setting->thankyou_page || is_null($store->script_tag_id) || !$store->isEnabled()) {
                return response(null, Response::HTTP_NO_CONTENT);
            }

            return view('script', [
                'html'      =>  $this->couponService->getScriptTag($setting->discount_amount, $setting->discount_type, $setting->currency, $setting->color)
            ]);
        } catch (Throwable $ex) {
            AppLogger::setStore($store)->error($ex, 'affiliate:script-tag');

            return response(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}