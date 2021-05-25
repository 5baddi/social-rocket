<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Http\Controllers\Auth\SignOutController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\HelpController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\AccountController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts\PayoutsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Plan\UpgradePlanController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings\SettingsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts\SendPayoutController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\CustomizeController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\UpdateAccountController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\SubscriptionController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\BillingPaymentController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\BillingConfirmationController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\IntegrationsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Preview\CheckoutPreviewController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings\UpdateSettingsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\CancelSubscriptionController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityMarkAsReadController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\Mails\PurchaseMailController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\UpdateIntegrationsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityMarkAllAsReadController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\SaveCustomizeSettingController;


Route::middleware(['auth', 'has.subscription'])
    ->name('subscription')
    ->prefix('subscription')
    ->group(function() {
        Route::get('/', SubscriptionController::class)->name('.select.pack');
        Route::get('/billing/{pack}', BillingPaymentController::class)->name('.pack.billing');
        Route::get('/billing/{pack}/confirmation', BillingConfirmationController::class)->name('.billing.confirmation');
    });
    
Route::middleware(['auth', 'has.subscription', 'store-owner'])
    ->name('dashboard')
    ->prefix('dashboard')
    ->group(function() {
        Route::get('/', IndexController::class);
        Route::post('/', IndexController::class);

        Route::get('/customize', CustomizeController::class)->name('.customize');
        Route::post('/customize', SaveCustomizeSettingController::class)->name('.customize.save');
        Route::get('/customize/integrations', IntegrationsController::class)->name('.customize.integrations');
        Route::post('/customize/integrations', UpdateIntegrationsController::class)->name('.customize.integrations.save');
        Route::prefix('customize/integrations')
            ->name('.customize.integrations')
            ->group(function() {
                Route::get('/mails/purchase', PurchaseMailController::class)->name('.mails.purchase');
            });
        
        Route::get('/payouts', PayoutsController::class)->name('.payouts');
        Route::post('/payouts/{commission}', SendPayoutController::class)->name('.payouts.send');

        Route::get('/account', AccountController::class)->name('.account');
        Route::post('/account', UpdateAccountController::class)->name('.account.save');

        Route::get('/settings', SettingsController::class)->name('.settings');
        Route::post('/settings', UpdateSettingsController::class)->name('.settings.save');

        Route::get('/help', HelpController::class)->name('.help');

        Route::get('/activity', ActivityController::class)->name('.activity');
        Route::get('/activity/read', ActivityMarkAllAsReadController::class)->name('.activity.read.all');
        Route::get('/activity/{notification}', ActivityMarkAsReadController::class)->name('.activity.read');

        Route::get('/preview/checkout', CheckoutPreviewController::class)->name('.preview.checkout');

        Route::get('/plan', function() {
            return redirect()->route('dashboard.account', ['tab' => 'plan']);
        })->name('.plan');
        Route::get('/plan/upgrade', UpgradePlanController::class)->name('.plan.upgrade');
        Route::get('/plan/cancel', CancelSubscriptionController::class)->name('.plan.cancel');

        Route::get('/logout', SignOutController::class)->name('.signout');
    });