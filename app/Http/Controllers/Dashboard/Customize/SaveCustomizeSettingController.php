<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Entities\Alert;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Services\SettingService;
use BADDIServices\SocialRocket\Http\Requests\SaveCustomizeSettingRequest;
use BADDIServices\SocialRocket\Models\Store;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SaveCustomizeSettingController extends Controller
{
    /** @var SettingService */
    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function __invoke(SaveCustomizeSettingRequest $request)
    {
        try {
            /** @var User */
            $user = Auth::user();
            $user->load('store');

            $store = $user->store;
            if (!$store instanceof Store) {
                throw new NotFoundHttpException('Store not found!');
            }

            $setting = $this->settingService->save($store, $request->input());

            return redirect()->route('dashboard.customize')
                            ->withInput($setting->toArray())
                            ->with(
                                'alert', 
                                new Alert('Customized setting saved successfully', 'success')
                            );
        } catch (NotFoundHttpException $ex){
            return redirect()->route('dashboard.customize')->with(
                'alert', 
                new Alert($ex->getMessage())
            );
        } catch (Throwable $ex){
            return redirect()->route('dashboard.customize')->with(
                'alert', 
                new Alert('Error saving customized setting')
            );
        }
    }
}