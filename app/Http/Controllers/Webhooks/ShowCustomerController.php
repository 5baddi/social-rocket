<?php


/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Webhooks;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\Webhooks\DeleteStoreRequest;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;

class ShowCustomerController extends BaseController
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var StoreService */
    private $storeService;

    public function __construct(ShopifyService $shopifyService, StoreService $storeService)
    {
        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
    }
    
    public function __invoke(DeleteStoreRequest $request)
    {
        $slug = $this->shopifyService->getStoreName($request->input('shop_domain'));
        if (is_null($slug)) {
            abort(Response::HTTP_NOT_FOUND, 'Shop not found');
        }

        $store = $this->storeService->findBySlug($slug);
        if (!$store instanceof Store || !$store->user instanceof User) {
            abort(Response::HTTP_NOT_FOUND, 'Shop not found');
        }
        
        return response()->json([
            'shop'      =>  $store->toArray(),
            'customer'  =>  $store->user->toArray(),
        ]);
    }
}