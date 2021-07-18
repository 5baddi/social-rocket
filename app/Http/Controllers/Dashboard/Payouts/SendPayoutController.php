<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts;

use Throwable;
use BADDIServices\SocialRocket\Entities\Alert;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Payouts\SendPayoutRequest;
use BADDIServices\SocialRocket\Models\Commission;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Services\CommissionService;
use BADDIServices\SocialRocket\Http\Controllers\DashboardController;

class SendPayoutController extends DashboardController
{
    /** @var CommissionService */
    private $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        parent::__construct();

        $this->commissionService = $commissionService;
    }

    public function __invoke(Commission $commission, SendPayoutRequest $request)
    {
        try {
            $this->commissionService->pay($commission, $request->input());

            return redirect()->back()
                            ->with(
                                'alert', 
                                new Alert('Payment sent successfully', 'success')
                            );
        } catch (ValidationException $ex) {
            $errors = collect($ex->errors);

            return redirect()->route('dashboard.payouts')
                            ->with(
                                'alert', 
                                new Alert($errors->first())
                            );
        } catch (Throwable $ex) {
            AppLogger::error($ex, 'store:send-payment', ['playload' => $request->all()]);

            return redirect()->back()
                            ->with(
                                'alert', 
                                new Alert('Error during send the payment')
                            );
        }
    }
}