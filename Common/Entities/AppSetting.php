<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities;

class AppSetting extends Entity
{
    /** @var string */
    public const KEY_COLUMN = 'key';
    public const VALUE_COLUMN = 'value';
    public const SUPPORT_EMAIL_COLUMN = 'support_email';
    public const INSTAGRAM_USERNAME_COLUMN = 'instagram_username';
    public const TWITTER_USERNAME_COLUMN = 'twitter_username';
    public const FACEBOOK_USERNAME_COLUMN = 'facebook_username';
    public const SHOPIFY_APP_SLUG_COLUMN = 'shopify_app_slug';

    public function getFacebookUsername(): string
    {
        return sprintf("https://facebook.com/%s?utm_source=%s", $this->getAttribute(self::FACEBOOK_USERNAME_COLUMN), config('app.name'));
    }

    public function getTwitterUsername(): string
    {
        return sprintf("https://twitter.com/%s?utm_source=%s", $this->getAttribute(self::TWITTER_USERNAME_COLUMN), config('app.name'));
    }

    public function getInstagramUsername(): string
    {
        return sprintf("https://instagram.com/%s?utm_source=%s", $this->getAttribute(self::INSTAGRAM_USERNAME_COLUMN), config('app.name'));
    }

    public function getAppLinkOnShopifyAppStore(): string
    {
        return sprintf("https://apps.shopify.com/%s?utm_source=%s", $this->getAttribute(self::SHOPIFY_APP_SLUG_COLUMN), config('app.name'));
    }
}
