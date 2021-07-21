<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Affiliate;

use Throwable;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use BADDIServices\ClnkGO\Models\Order;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Setting;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Models\Commission;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Entities\StoreSetting;
use BADDIServices\ClnkGO\Services\OrderService;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Services\CouponService;
use BADDIServices\ClnkGO\Services\ProductService;
use BADDIServices\ClnkGO\Services\ShopifyService;
use BADDIServices\ClnkGO\Services\CommissionService;
use BADDIServices\ClnkGO\Exceptions\Shopify\OrderNotFound;
use BADDIServices\ClnkGO\Exceptions\Shopify\ProductNotFound;
use BADDIServices\ClnkGO\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\ClnkGO\Http\Controllers\AffiliateController;
use BADDIServices\ClnkGO\Http\Requests\Affiliate\NewOrderRequest;
use BADDIServices\ClnkGO\Exceptions\Shopify\CreatePriceRuleFailed;

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
            $store->load('setting');

            /** @var Setting */
            $setting = $store->setting;
            if (!$setting instanceof Setting) {
                $setting = new StoreSetting(); 
            }

            $shopifyOrder = collect($this->shopifyService->getOrder($store, $request->input(Order::ORDER_ID_COLUMN)));

            $lineItems = collect($shopifyOrder->get('line_items', []));
            $productData = collect($lineItems->first());

            if ($productData->has('product_id')) {
                $shopifyProduct = $this->shopifyService->getProduct($store, $productData->get('product_id'));
                $productSlug = Arr::get($shopifyProduct, 'handle');
            }

            $customer = collect($shopifyOrder->get('customer'), []);
            $affiliate = $this->userService->exists($customer->get('id'));

            if (!$affiliate instanceof User) {
                $affiliate = $this->userService->create($store, $customer->toArray(), true);

                $priceRule = $this->shopifyService->createPriceRule(
                    $store, 
                    [
                        'title'                 =>  $affiliate->coupon,
                        'value_type'            =>  $setting->discount_type === Setting::FIXED_TYPE ? 'fixed_amount' : $setting->discount_type,
                        'value'                 =>  -$setting->discount_amount
                    ]
                );

                DB::commit();
            }

            $coupons = $this->userService->coupons($store);
            $discounts = collect($shopifyOrder->get('discount_codes', []));

            $existsByCoupons = $discounts
                ->whereIn('code', $coupons)
                ->first();
                
            if (!is_null($existsByCoupons)) {    
                $order = $this->orderService->save($store, $shopifyOrder->toArray());

                $commission = $this->commissionService->exists($store, $affiliate, $order);
                if (!$commission instanceof Commission) {
                    $commission = $this->commissionService->calculate($store, $affiliate, $order);
                }

                if ($productData->has('product_id')) {
                    $product = $this->productService->save($store, $shopifyProduct);
                    $this->orderService->attachProduct($store, $order, $product, $lineItems);

                    $productSlug = $product->slug;
                }

                DB::commit();
            }

            if ($setting->thankyou_page) {
                return response()->json([
                    User::COUPON_COLUMN     => $affiliate->coupon,
                    'discount'              => $this->couponService->getDiscount($setting->discount_amount, $setting->discount_type, $setting->currency),
                    'color'                 => $setting->color,
                    'url'                   => $this->shopifyService->getProductWithDiscountURL($store, $productSlug, $affiliate->coupon)
                ]);
            }

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (CustomerNotFound | OrderNotFound | ProductNotFound | CreatePriceRuleFailed $ex) {
            DB::rollBack();

            $this->logger->setStore($store)->error($ex, 'affiliate:new-order', ['playload' => $request->all()]);

            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $ex) {
            DB::rollBack();

            $this->logger->setStore($store)->error($ex, 'affiliate:new-order', ['playload' => $request->all()]);
            
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}