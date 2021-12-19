<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account;

use Throwable;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use BADDIServices\SocialRocket\Http\Controllers\DashboardController;
use BADDIServices\SocialRocket\Exceptions\Shopify\CancelSubscriptionFailed;

class CancelSubscriptionController extends DashboardController
{
    /** @var SubscriptionService */
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        parent::__construct();

        $this->subscriptionService = $subscriptionService;
    }
    
    public function __invoke()
    {
        try {
            $this->subscriptionService->cancelSubscription($this->user, $this->store, $this->subscription);

            return redirect()
                        ->route('subscription.select.pack')
                        ->with('success', 'Subscription has been canceled successfully');
        } catch (CancelSubscriptionFailed $ex) {
            return redirect()
                        ->back()
                        ->with(
                            'alert',
                            new Alert($ex->getMessage())
                        );
        } catch (Throwable $ex) {
            return redirect()
                        ->route('subscription.select.pack')
                        ->with('error', 'Something going wrong during cancel subscription');
        }
    }
}