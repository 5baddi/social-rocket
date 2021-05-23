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
use BADDIServices\SocialRocket\Http\Requests\UpdateIntegrationsSettingsRequest;

class UpdateIntegrationsController extends DashboardController
{
    /** @var SettingService */
    private $settingService;

    public function __construct(SettingService $settingService)
    {
        parent::__construct();
        
        $this->settingService = $settingService;
    }

    public function __invoke(UpdateIntegrationsSettingsRequest $request)
    {
        try {
            $setting = $this->settingService->saveIntegrationsSetting($this->store, $request->input());

            return redirect()->route('dashboard.customize.integrations')
                            ->withInput($setting->toArray())
                            ->with(
                                'alert', 
                                new Alert('IIntegrations setting saved successfully', 'success')
                            );
        } catch (ValidationException $ex){
            return redirect()->route('dashboard.customize.integrations')
                            ->withErrors($ex->errors)
                            ->withInput();
        } catch (NotFoundHttpException $ex){
            return redirect()->route('dashboard.customize.integrations')
                            ->with(
                                'alert', 
                                new Alert($ex->getMessage())
                            )
                            ->withInput();
        } catch (Throwable $ex){
            return redirect()->route('dashboard.customize.integrations')
                            ->with(
                                'alert', 
                                new Alert('Error saving integrations setting')
                            )
                            ->withInput();
        }
    }
}