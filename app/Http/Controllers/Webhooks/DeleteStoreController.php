<?php


/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;
use App\Http\Requests\Webhooks\StoreRequest;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\ShopifyService;

class DeleteStoreController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        parent::__construct();

        $this->shopifyService = $shopifyService;
    }
    
    public function __invoke(StoreRequest $request)
    {
        $slug = $this->shopifyService->getStoreName($request->input('shop_domain'));
        if ($slug === null) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid shop URL');
        }

        $store = $this->storeService->findBySlug($slug);
        if (!$store instanceof Store) {
            abort(Response::HTTP_NOT_FOUND, 'Shop not found');
        }

        $storeDeleted = $this->storeService->delete($store);

        if (!$storeDeleted) {
            return response()->json(['Something going wrong during deleting shop data!'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['Shop data deleted successfully.']);
    }
}