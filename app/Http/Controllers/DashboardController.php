<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\SocialRocket\Models\Subscription;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User */
    protected $user;

    /** @var Store */
    protected $store;
    
    /** @var Subscription */
    protected $subscription;

    public function __construct()
    {
        /** @var User */
        $this->user = Auth::user();
        $this->user->load('store');

        $this->store = $this->user->store;
        $this->store->load('subscription');
        $this->subscription = $this->store->subscription;
    }
}