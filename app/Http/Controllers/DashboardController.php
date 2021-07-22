<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\ClnkGO\Models\Setting;
use BADDIServices\ClnkGO\Models\Subscription;
use BADDIServices\ClnkGO\Entities\StoreSetting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /** @var Setting */
    protected $setting;
    
    /** @var Subscription */
    protected $subscription;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            if ($this->user instanceof User && $this->store instanceof Store) {
                $this->subscription = $this->user->subscription;

                $this->store->load('setting');
                $this->setting = $this->store->setting;

                if (!$this->setting instanceof Setting) {
                    $this->setting = new StoreSetting();
                }

                if ($request->has('notification')) {
                    $this->user->unreadNotifications->where('id', $request->query('notification'))->markAsRead();
                }
            }

            return $next($request);
        });
    }
}