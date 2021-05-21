<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use App\Models\User;
use Throwable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use BADDIServices\SocialRocket\Models\Order;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use BADDIServices\SocialRocket\Services\OrderService;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\CouponService;
use BADDIServices\SocialRocket\Services\ProductService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\UserService;
use BADDIServices\SocialRocket\Exceptions\Shopify\OrderNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\ProductNotFound;
use BADDIServices\SocialRocket\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\SocialRocket\Http\Controllers\AffiliateController;
use BADDIServices\SocialRocket\Http\Requests\Affiliate\NewOrderRequest;
use BADDIServices\SocialRocket\Exceptions\Shopify\CreatePriceRuleFailed;

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

    public function __construct(StoreService $storeService, ShopifyService $shopifyService, UserService $userService, OrderService $orderService, ProductService $productService, CouponService $couponService)
    {
        parent::__construct($storeService, $shopifyService);

        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->couponService = $couponService;
    }

    public function __invoke(NewOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $store = $this->storeService->findBySlug($request->get(Store::SLUG_COLUMN));
            $shopifyOrder = collect($this->shopifyService->getOrder($store, $request->input(Order::ORDER_ID_COLUMN)));

            $coupons = $this->userService->coupons($store);
            $discounts = collect($shopifyOrder->get('discount_codes', []));

            $existsByCoupons = $discounts
                ->whereIn('code', $coupons)
                ->first();

            if ($shopifyOrder->has('customer') && $shopifyOrder->has('line_items') && !is_null($existsByCoupons)) {
                $store->load('setting');

                /** @var Setting */
                $setting = $store->setting;
                if (!$setting instanceof Setting) {
                    $setting = new StoreSetting(); 
                }

                $customer = collect($shopifyOrder->get('customer'), []);
                $affiliate = $this->userService->exists($customer->get('id'));
                if (!$affiliate instanceof User) {
                    $affiliate = $this->userService->create($store, $customer->toArray());

                    $priceRule = $this->shopifyService->createPriceRule(
                        $store, 
                        [
                            'title'                 =>  $affiliate->coupon,
                            'value_type'            =>  $setting->discount_type === Setting::FIXED_TYPE ? 'fixed_amount' : $setting->discount_type,
                            'value'                 =>  -$setting->discount_amount
                        ]
                    );
                }
                
                $order = $this->orderService->save($store, $shopifyOrder->toArray());
                
                $lineItems = collect($shopifyOrder->get('line_items', []));
                $productData = collect($lineItems->first());
                if ($productData->has('product_id')) {
                    $shopifyProduct = $this->shopifyService->getProduct($store, $productData->get('product_id'));
                    $product = $this->productService->save($store, $shopifyProduct);

                    DB::commit();

                    return response()->json([
                        User::COUPON_COLUMN     => $affiliate->coupon,
                        'discount'              => $this->couponService->getDiscount($setting->discount_amount, $setting->discount_type, $setting->currency),
                        'color'                 => $setting->color,
                        'url'                   => $this->shopifyService->getProductWithDiscountURL($store, $product->slug, $affiliate->coupon)
                    ]);
                }
            }

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (CustomerNotFound | OrderNotFound | ProductNotFound | CreatePriceRuleFailed $ex) {
            DB::rollBack();

            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $ex) {
            DB::rollBack();

            Log::error($ex->getMessage(), [
                'context'   =>  'affiliate:new-order',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);
            
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}