<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use BADDIServices\SocialRocket\Services\AppService;
use BADDIServices\SocialRocket\Services\UserService;
use Illuminate\Routing\Controller as BaseController;
use BADDIServices\SocialRocket\Services\SettingService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var UserService */
    protected $userService;

    /** @var AppService */
    protected $appService;
    
    /** @var SettingService */
    protected $settingService;

    /** @var User|null */
    protected $user;

    /** @var string */
    protected $baseView = 'Admin';

    public function __construct()
    {
        /** @var UserService */
        $this->userService = app(UserService::class);

        /** @var AppService */
        $this->appService = app(AppService::class);

        /** @var SettingService */
        $this->settingService = app(SettingService::class);

        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->user = $this->userService->findById(Auth::id());
            }

            return $next($request);
        });

    }

    protected function renderView(string $view, array $data = [])
    {
        return $this->view(
            sprintf('%s::%s', $this->baseView, $view),
            array_merge($this->baseData(), $data)
        );
    }

    protected function baseData(): array
    {
        return [
            'user'  =>  $this->user
        ];
    }
}
