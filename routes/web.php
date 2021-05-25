<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Support\Facades\Route;
use BADDIServices\SocialRocket\Http\Controllers\Auth\ResetPassword  as ResetPassword;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignInController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignUpController;
use BADDIServices\SocialRocket\Http\Controllers\LandingPageController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\ConnectController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\SignOutController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\HelpController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\CreateUserController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\IndexController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\AuthenticateController;
use BADDIServices\SocialRocket\Http\Controllers\OrderStatusScriptController;
use BADDIServices\SocialRocket\Http\Controllers\OAuth\OAuthCallbackController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\AccountController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts\PayoutsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Plan\UpgradePlanController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings\SettingsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Payouts\SendPayoutController;
use BADDIServices\SocialRocket\Http\Controllers\Affiliate\Dashboard\AnalyticsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\CustomizeController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\SubscriptionController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\UpdateAccountController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\BillingPaymentController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\IntegrationsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Preview\CheckoutPreviewController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Settings\UpdateSettingsController;
use BADDIServices\SocialRocket\Http\Controllers\Affiliate\Inscription\CreateAccountController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Account\CancelSubscriptionController;
use BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription\BillingConfirmationController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityMarkAsReadController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\Mails\PurchaseMailController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\UpdateIntegrationsController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Activity\ActivityMarkAllAsReadController;
use BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\SaveCustomizeSettingController;
use BADDIServices\SocialRocket\Http\Controllers\Affiliate\Inscription\SignUpController as AffiliateSignUpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ?hmac=1e0562ac48d089dc7eff26a142c19a84ca4e59df2a8e92d0708799aee2faf108&shop=social-rocket-test-store.myshopify.com&timestamp=1621623778

Route::get('/', LandingPageController::class)->name('landing')->middleware(['signin.with.app']);

Route::redirect('/guide', '/', 301)->name('guide');
Route::redirect('/guide/affiliate/setup', env('GUIDE_SETUP', '/'), 301)->name('guide.affiliate.setup');
Route::redirect('/privacy.html', '/', 301)->name('privacy');
Route::redirect('/termsofservice.html', '/', 301)->name('termsofservice');

Route::middleware(['cors'])->group(function() {
    Route::get('/order_status.js', OrderStatusScriptController::class);
});

Route::name('affiliate')
    ->prefix('affiliate')
    ->group(function() {
        Route::redirect('/', '/', 301);

        Route::get('/{store}', AffiliateSignUpController::class);
        Route::post('/{store}/signup', CreateAccountController::class)->name('.signup');

        Route::middleware(['auth', 'is.affiliate'])
            ->group(function() {
                Route::get('/analytics', AnalyticsController::class)->name('.analytics');
            });
    });

Route::middleware('guest')
    ->group(function() {
        Route::get('/connect', ConnectController::class)->middleware(['has.store', 'app.connected'])->name('connect');
        Route::post('/connect', OAuthController::class)->name('oauth.connect');
        Route::get('/oauth/callback', OAuthCallbackController::class)->name('oauth.callback');

        Route::get('/signup', SignUpController::class)->middleware(['has.store', 'app.notconnected'])->name('signup');
        Route::post('/auth/signup', CreateUserController::class)->name('auth.signup');
        Route::get('/signin', SignInController::class)->name('signin');
        Route::post('/auth/signin', AuthenticateController::class)->name('auth.signin');

        Route::get('/reset', ResetPassword\IndexController::class)->name('reset');
        Route::post('/auth/token', ResetPassword\ResetTokenController::class)->name('auth.reset.token');
        Route::get('/reset/{token}', ResetPassword\EditController::class)->name('password');
        Route::post('/auth/password', ResetPassword\ResetPasswordController::class)->name('auth.reset.password');
    });
        
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