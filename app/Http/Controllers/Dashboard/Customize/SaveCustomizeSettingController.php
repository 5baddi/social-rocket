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
use BADDIServices\ClnkGO\Http\Requests\SaveCustomizeSettingRequest;

class SaveCustomizeSettingController extends DashboardController
{
    /** @var SettingService */
    private $settingService;

    public function __construct(SettingService $settingService)
    {
        parent::__construct();
        
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