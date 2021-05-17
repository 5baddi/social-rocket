<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use Throwable;
use App\Models\User;
use BADDIServices\SocialRocket\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Services\MailListService;
use BADDIServices\SocialRocket\Exceptions\Shopify\CustomerNotFound;
use BADDIServices\SocialRocket\Http\Controllers\AffiliateController;
use BADDIServices\SocialRocket\Http\Requests\Affiliate\NewOrderRequest;

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
            $customer = $this->shopifyService->getCustomer($store, $request->input(User::CUSTOMER_ID_COLUMN));
            return $customer;

            return response()->json($request->all());
        } catch (CustomerNotFound $ex) {
            return response()->json($ex->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $ex) {
            return $ex->getMessage();
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}