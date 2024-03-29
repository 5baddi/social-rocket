<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use Throwable;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Models\Commission;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\CouponService;
use BADDIServices\SocialRocket\Services\ProductService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\CommissionService;
use BADDIServices\SocialRocket\Exceptions\Shopify\OrderNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\ProductNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\SocialRocket\Http\Controllers\AffiliateController;
use BADDIServices\SocialRocket\Http\Requests\Affiliate\NewOrderRequest;
use BADDIServices\SocialRocket\Exceptions\Shopify\CreatePriceRuleFailed;
use BADDIServices\SocialRocket\Jobs\NotifyAboutNewOrder;
use Illuminate\Support\Collection;

class NewOrderController extends AffiliateController
{
    /** @var UserService */
    private $userService;

    /** @var ProductService */
    private $productService;
    
    /** @var OrderService */
    private $orderService;
    
    /** @var CouponService */
    private $couponService;

    /** @var CommissionService */
    private $commissionService;

    public function __construct(StoreService $storeService, ShopifyService $shopifyService, UserService $userService, OrderService $orderService, ProductService $productService, CouponService $couponService, CommissionService $commissionService)
    {
        parent::__construct($storeService, $shopifyService);

        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->couponService = $couponService;
        $this->commissionService = $commissionService;
    }

    public function __invoke(NewOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $store = $this->storeService->findBySlug($request->get(Store::SLUG_COLUMN));
            if (! $store instanceof Store) {
                return response()->json([], Response::HTTP_NO_CONTENT);
            }

            $setting = $store->getSetting();
            if (! $setting->isThankYouPageEnabled()) {
                return response()->json([], Response::HTTP_NO_CONTENT);
            }

            NotifyAboutNewOrder::dispatch($request->get(Store::SLUG_COLUMN), $request->input(Order::ORDER_ID_COLUMN));

            $shopifyOrder = Collection::make($this->shopifyService->getOrder($store, $request->input(Order::ORDER_ID_COLUMN)));

            $lineItems = Collection::make($shopifyOrder->get('line_items', []));
            $productData = Collection::make($lineItems->first());

            if ($productData->has('product_id')) {
                $shopifyProduct = $this->shopifyService->getProduct($store, $productData->get('product_id'));
                $productSlug = Arr::get($shopifyProduct, 'handle');
            }

            $affiliate = $this->userService->exists($shopifyOrder->get('customer.id'));
            if (! $affiliate instanceof User) {
                $affiliate = $this->userService->create($store, $$shopifyOrder->get('customer'), true);
            }

            DB::commit();

            return response()->json([
                User::COUPON_COLUMN     => $affiliate->coupon,
                'discount'              => $this->couponService->getDiscount($setting->discount_amount, $setting->discount_type, $setting->currency),
                'color'                 => $setting->color,
                'url'                   => $this->shopifyService->getProductWithDiscountURL($store, $productSlug, $affiliate->coupon)
            ]);
        } catch (CustomerNotFound | OrderNotFound | ProductNotFound | CreatePriceRuleFailed $ex) {
            DB::rollBack();

            AppLogger::setStore($store)->error($ex, 'affiliate:new-order', ['playload' => $request->all()]);

            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $ex) {
            DB::rollBack();

            AppLogger::setStore($store)->error($ex, 'affiliate:new-order', ['playload' => $request->all()]);
            
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}