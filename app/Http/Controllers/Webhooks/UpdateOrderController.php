<?php


/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Webhooks;

use App\Models\User;
use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;
use App\Http\Requests\Webhooks\OrderRequest;
use BADDIServices\ClnkGO\Services\OrderService;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\ClnkGO\Services\Shopify\ShopifyService;
use Throwable;

class UpdateOrderController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var OrderService */
    private $orderService;

    public function __construct(ShopifyService $shopifyService, OrderService $orderService)
    {
        parent::__construct();

        $this->shopifyService = $shopifyService;
        $this->orderService = $orderService;
    }
    
    public function __invoke(OrderRequest $request)
    {
        try {
            $this->orderService->exists();

            $this->logger->info(
                sprintf('order #%s updated', $request->input('id')), 
                'webhooks:shopify-order-updated', 
                ['playload' => $request->all()]
            );
        } catch (Throwable $e) {

        }
    }
}