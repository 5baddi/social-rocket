<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\SocialRocket\Services\UserService;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\SocialRocket\Services\StatsService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User */
    protected $user;

    /** @var UserService */
    protected $userService;
    
    /** @var StatsService */
    protected $statsService;

    public function __construct(UserService $userService, StatsService $statsService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

        $this->userService = $userService;
        $this->statsService = $statsService;
    }
}