<?php


/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Webhooks;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\UserService;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\Webhooks\DeleteStoreRequest;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;

class DeleteStoreController extends BaseController
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var UserService */
    private $userService;

    /** @var StoreService */
    private $storeService;

    public function __construct(ShopifyService $shopifyService, UserService $userService, StoreService $storeService)
    {
        $this->shopifyService = $shopifyService;
        $this->userService = $userService;
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

        $storeDeleted = $this->storeService->delete($store);
        $userDeleted = $this->userService->delete($store->user);
        if (!$storeDeleted || !$userDeleted) {
            return response()->json(['Something going wrong during deleting customer data!'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['Customer data deleted successfully.']);
    }
}