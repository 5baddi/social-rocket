<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\OAuth;

use BADDIServices\SocialRocket\Common\FeatureList;
use BADDIServices\SocialRocket\Common\LogParametersList;
use BADDIServices\SocialRocket\Common\Services\Shopify\MyShopService;
use BADDIServices\SocialRocket\Common\Services\Shopify\OauthService;
use BADDIServices\SocialRocket\Http\Requests\Oauth\ConnectShopRequest;
use Throwable;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService as OldShopifyService;

class OAuthController extends Controller
{
    public function __construct(
        private OldShopifyService $shopifyService,
        private MyShopService $myShopService,
        private StoreService $storeService,
        private OauthService $oauthService
    ) {
        parent::__construct();
    }

    public function __invoke(ConnectShopRequest $request)
    {
        try {
            $shopSlug = $this->myShopService->getShopSlug($request->input('shop'));
            if (is_null($shopSlug)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', __('auth.shop.url_invalid'));
            }

            $shopIsLinked = $this->myShopService->shopIsAlreadyLinked($shopSlug);
            if ($shopIsLinked) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', __('auth.shop.is_linked'));
            }

            $oauthURL = $this->oauthService->getRedirectUrl(
                $this->myShopService->getShopUrl($shopSlug),
                route('oauth.callback')
            );

            return redirect($oauthURL);
        } catch (Throwable $e) {
            $this->logger->error(
                'an error occurred while connecting the shop with shopify app',
                [
                    LogParametersList::FEATURE          => FeatureList::SHOPIFY,
                    LogParametersList::SUB_FEATURE      => FeatureList::OAUTH,
                    LogParametersList::SHOP_SLUG        => optional($shopSlug),
                    LogParametersList::PAYLOAD          => $request->all(),
                    LogParametersList::ERROR_CODE       => $e->getCode(),
                    LogParametersList::ERROR_MESSAGE    => $e->getMessage(),
                    LogParametersList::ERROR_TRACE      => $e->getTraceAsString(),
                ]
            );

            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('auth.shop.connect_error'));
        }
    }
}
