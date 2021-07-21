<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Payouts;

use Throwable;
use BADDIServices\ClnkGO\Entities\Alert;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Payouts\SendPayoutRequest;
use BADDIServices\ClnkGO\Models\Commission;
use BADDIServices\ClnkGO\Services\CommissionService;
use BADDIServices\ClnkGO\Http\Controllers\DashboardController;

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
            $this->logger->error($ex, 'store:send-payment', ['playload' => $request->all()]);

            return redirect()->back()
                            ->with(
                                'alert', 
                                new Alert('Error during send the payment')
                            );
        }
    }
}