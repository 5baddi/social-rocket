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
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Models\MailList;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\MailListService;
use BADDIServices\SocialRocket\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\SocialRocket\Http\Controllers\AffiliateController;
use BADDIServices\SocialRocket\Http\Requests\Affiliate\NewOrderRequest;
use BADDIServices\SocialRocket\Models\Tracker;

class NewOrderController extends AffiliateController
{
    
    
    /** @var MailListService */
    private $mailListService;

    public function __construct(StoreService $storeService, ShopifyService $shopifyService, MailListService $mailListService)
    {
        parent::__construct($storeService, $shopifyService);
        $this->mailListService = $mailListService;
    }

    public function __invoke(NewOrderRequest $request)
    {
        try {
            $store = $this->storeService->findBySlug($request->get(Store::SLUG_COLUMN));
            $order = $this->shopifyService->getOrder($store, $request->input(Tracker::ORDER_ID_COLUMN));
            return $order;

            if (is_array($order) && isset($order['customer'])) {
                $mailList = $this->mailListService->exists($order['customer']['id']);
                if (!$mailList instanceof MailList) {
                    $mailList = $this->mailListService->create($store, $order['customer']);
                }

                // $amount = Setting::DISCOUNT_AMOUNT_COLUMN;
                // $type = Setting::FIXED_TYPE;
                // $currency = Setting::DEFAULT_CURRENCY;
                // $color = Setting::DEFAULT_COLOR;

                // /** @var Setting */
                // $setting = $store->load('setting');

                return response()->json([
                    MailList::COUPON_COLUMN => $mailList->coupon,
                    // 'amount'                =>  $amount
                ]);
            }

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (CustomerNotFound $ex) {
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $ex) {
            return $ex->getMessage();
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}