<?php


/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Webhooks;

use App\Models\User;
use BADDIServices\SocialRocket\Models\Store;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Webhooks\StoreRequest;
use BADDIServices\SocialRocket\Services\UserService;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;

class ShowCustomerController extends BaseController
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var StoreService */
    private $storeService;
    
    /** @var UserService */
    private $userService;

    public function __construct(
        ShopifyService $shopifyService,
        StoreService $storeService,
        UserService $userService
    )
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
        $this->userService = $userService;
    }
    
    public function __invoke(StoreRequest $request)
    {
        $slug = $this->shopifyService->getStoreName($request->input('shop_domain'));
        if (is_null($slug)) {
            abort(Response::HTTP_NOT_FOUND, 'Shop not found');
        }

        $store = $this->storeService->findBySlug($slug);
        if (!$store instanceof Store) {
            abort(Response::HTTP_NOT_FOUND, 'Shop not found');
        }

        $user = $this->userService->getStoreOwner($store);
        if (!$user instanceof User) {
            abort(Response::HTTP_NOT_FOUND, 'Customer not found');
        }
        
        return response()->json([
            'shop'              => [
                'name'          => $store->name,
                'slug'          => $store->slug,
                'email'         => $store->email,
                'domain'        => $store->domain,
                'phone'         => $store->phone,
                'country'       => $store->country,
                'connected_at'  => $store->connected_at,
            ],
            'customer'          => [
                'customer_id'   => $user->customer_id,
                'email'         => $user->email,
                'first_name'    => $user->first_name,
                'last_name'     => $user->last_name,
                'phone'         => $user->phone,
                'coupon'        => $user->coupon,
            ],
        ]);
    }
}