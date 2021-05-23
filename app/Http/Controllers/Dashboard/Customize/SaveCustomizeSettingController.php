<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize;

use Throwable;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Http\Controllers\DashboardController;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Services\SettingService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BADDIServices\SocialRocket\Http\Requests\SaveCustomizeSettingRequest;

class SaveCustomizeSettingController extends DashboardController
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
            $setting = $this->settingService->save($this->store, $request->input());

            return redirect()->route('dashboard.customize')
                            ->withInput($setting->toArray())
                            ->with(
                                'alert', 
                                new Alert('Customized setting saved successfully', 'success')
                            );
        } catch (ValidationException $ex){
            return redirect()->route('dashboard.customize')
                            ->withErrors($ex->errors)
                            ->withInput();
        } catch (NotFoundHttpException $ex){
            return redirect()->route('dashboard.customize')
                            ->with(
                                'alert', 
                                new Alert($ex->getMessage())
                            )
                            ->withInput();
        } catch (Throwable $ex){
            return redirect()->route('dashboard.customize')
                            ->with(
                                'alert', 
                                new Alert('Error saving customized setting')
                            )
                            ->withInput();
        }
    }
}