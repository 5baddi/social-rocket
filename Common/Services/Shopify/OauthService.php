<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services\Shopify;

use BADDIServices\SocialRocket\Common\Services\Service;

class OauthService extends Service
{
    public const DEFAULT_SCOPES = "read_orders,read_customers,read_products,read_checkouts,read_price_rules,"
    . "write_price_rules,read_discounts,write_discounts,read_script_tags,write_script_tags";
    public const OAUTH_AUTHORIZE_ENDPOINT = "/admin/oauth/authorize";

    public function __construct()
    {
        parent::__construct();
    }

    public function getRedirectUrl(string $shopUrl, string $redirectUri, string $scopes = self::DEFAULT_SCOPES): string
    {
        return sprintf(
            '%s/%s?client_id=%s&scope=%s&redirect_uri=%s',
            $shopUrl,
            self::OAUTH_AUTHORIZE_ENDPOINT,
            '',
            $scopes,
            urlencode($redirectUri)
        );
    }
}
