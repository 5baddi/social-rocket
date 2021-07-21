<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Admin\Settings;

use Throwable;
use BADDIServices\ClnkGO\Entities\Alert;
use Illuminate\Validation\ValidationException;
use BADDIServices\ClnkGO\Services\AppService;
use BADDIServices\ClnkGO\Http\Requests\Admin\Settings\UpdateSettingsRequest;
use BADDIServices\ClnkGO\Http\Controllers\AdminController as ControllersAdminController;

class UpdateSettingsController extends ControllersAdminController
{
    /** @var AppService */
    private $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    public function __invoke(UpdateSettingsRequest $request)
    {
        try {
            // $this->appService->update($request->input());

            return redirect()
                ->back()
                ->with(
                    'alert', 
                    new Alert('Settings has been saved successfully', 'success')
                );
        } catch (ValidationException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (Throwable $e) {
            $this->logger->error($e, 'admin:update-settings');

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'alert', 
                    new Alert('Error during save settings')
                );
        }
    }
}