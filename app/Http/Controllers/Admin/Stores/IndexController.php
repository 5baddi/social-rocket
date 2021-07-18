<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Stores;

use App\Http\Requests\AnalyticsRequest;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;

class IndexController extends ControllersAdminController
{    
    /** @var SubscriptionService */
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        parent::__construct();
        
        $this->subscriptionService = $subscriptionService;
    }

    public function __invoke(AnalyticsRequest $request)
    {
        return view('admin.stores.index', [
            'title'                 =>  'stores',
            'subscriptions'         =>  $this->subscriptionService->paginateWithRelations($request->query('page'))
        ]);
    }
}