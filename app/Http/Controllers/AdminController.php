<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\ClnkGO\Services\UserService;
use BADDIServices\ClnkGO\Services\StatsService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var User */
    protected $user;

    /** @var UserService */
    protected $userService;
    
    /** @var StatsService */
    protected $statsService;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

        $this->userService = app(UserService::class);
        $this->statsService = app(StatsService::class);
    }
}