<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Customize;

use Throwable;
use BADDIServices\ClnkGO\Entities\Alert;
use BADDIServices\ClnkGO\Http\Controllers\DashboardController;
use Illuminate\Validation\ValidationException;
use BADDIServices\ClnkGO\Services\SettingService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use BADDIServices\ClnkGO\Http\Requests\UpdateIntegrationsSettingsRequest;

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