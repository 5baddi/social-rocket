<?php

namespace App\Http\Controllers;

use App\Models\User;
use BADDIServices\SocialRocket\Common\Services\AppService;
use BADDIServices\SocialRocket\Common\Services\FeatureService;
use BADDIServices\SocialRocket\Models\AppSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
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

    /** @var FeatureService */
    protected $featureService;

    /** @var User|null */
    protected $user;

    /** @var AppSetting|null */
    protected $appSettings;

    /** @var string */
    protected $baseView = 'App';

    public function __construct()
    {
        /** @var UserService */
        $this->userService = app(UserService::class);

        /** @var AppService */
        $this->appService = app(AppService::class);

        /** @var SettingService */
        $this->settingService = app(SettingService::class);

        /** @var FeatureService */
        $this->featureService = app(FeatureService::class);

        $this->loadAppSettings();

        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->user = $this->userService->findById(Auth::id());
            }

            return $next($request);
        });
    }

    protected function renderView(string $view, array $data = [])
    {
        return view(
            sprintf('%s::%s', $this->baseView, $view),
            array_merge($this->baseData(), $data)
        );
    }

    protected function baseData(): array
    {
        return [
            'user'              => $this->user,
            'settings'          => $this->appSettings,
            'featureService'    => $this->featureService
        ];
    }

    private function loadAppSettings(): void
    {
        $this->appSettings = $this->appService->settings();
    }
}
