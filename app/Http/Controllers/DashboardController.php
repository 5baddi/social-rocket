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
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Models\Subscription;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User */
    protected $user;

    /** @var Store */
    protected $store;
    
    /** @var Setting */
    protected $setting;
    
    /** @var Subscription */
    protected $subscription;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            $this->store = $this->user->store;
            $this->subscription = $this->user->subscription;

            $this->store->load('setting');
            $this->setting = $this->store->setting;

            if (!$this->setting instanceof Setting) {
                $this->setting = new StoreSetting();
            }

            if ($request->has('notification')) {
                $this->user->unreadNotifications->where('id', $request->query('notification'))->markAsRead();
            }

            return $next($request);
        });
    }
}