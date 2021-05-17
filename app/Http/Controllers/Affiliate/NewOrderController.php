<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use Throwable;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Models\Tracker;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Models\MailList;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\CouponService;
use BADDIServices\SocialRocket\Services\ProductService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\MailListService;
use BADDIServices\SocialRocket\Exceptions\Shopify\OrderNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\ProductNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\SocialRocket\Http\Controllers\AffiliateController;
use BADDIServices\SocialRocket\Http\Requests\Affiliate\NewOrderRequest;
use BADDIServices\SocialRocket\Models\Product;

class NewOrderController extends AffiliateController
{
    /** @var MailListService */
    private $mailListService;

    /** @var ProductService */
    private $productService;
    
    /** @var CouponService */
    private $couponService;

    public function __construct(StoreService $storeService, ShopifyService $shopifyService, MailListService $mailListService, ProductService $productService, CouponService $couponService)
    {
        parent::__construct($storeService, $shopifyService);

        $this->mailListService = $mailListService;
        $this->productService = $productService;
        $this->couponService = $couponService;
    }

    public function __invoke(NewOrderRequest $request)
    {
        try {
            $store = $this->storeService->findBySlug($request->get(Store::SLUG_COLUMN));
            $order = $this->shopifyService->getOrder($store, $request->input(Tracker::ORDER_ID_COLUMN));

            if (is_array($order) && isset($order['customer'], $order['line_items'], $order['line_items'][0], $order['line_items'][0]['product_id'])) {
                $mailList = $this->mailListService->exists($order['customer']['id']);
                if (!$mailList instanceof MailList) {
                    $mailList = $this->mailListService->create($store, $order['customer']);
                }

                $productId = $order['line_items'][0]['product_id'];
                $product = $this->productService->findById($productId);
                if (!$product instanceof Product) {
                    $product = $this->shopifyService->getProduct($store, $productId);

                    $product = $this->productService->create($store, $product);
                }

                $store->load('setting');

                /** @var Setting */
                $setting = $store->setting;
                if (!$setting instanceof Setting) {
                    $setting = new StoreSetting(); 
                }

                return response()->json([
                    MailList::COUPON_COLUMN => $mailList->coupon,
                    'discount'              => $this->couponService->getDiscount($setting->discount_amount, $setting->discount_type, $setting->currency),
                    'color'                 => $setting->color,
                    'url'                   => $this->shopifyService->getProductURL($store, $product->slug)
                ]);
            }

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (CustomerNotFound | OrderNotFound | ProductNotFound $ex) {
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $ex) {
            return $ex->getMessage();
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}