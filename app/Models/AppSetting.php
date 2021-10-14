<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Entities\ModelEntity;

class AppSetting extends ModelEntity
{
    /** @var string */
    public const TABLE = 'app_settings';
    public const SUPPORT_EMAIL_COLUMN = 'support_email';
    public const INSTAGRAM_USERNAME_COLUMN = 'instagram_username';
    public const TWITTER_USERNAME_COLUMN = 'twitter_username';
    public const FACEBOOK_USERNAME_COLUMN = 'facebook_username';
    public const SHOPIFY_APP_SLUG_COLUMN = 'shopify_app_slug';

    /** @var array */
    protected $fillable = [
        self::INSTAGRAM_USERNAME_COLUMN,
        self::TWITTER_USERNAME_COLUMN,
        self::FACEBOOK_USERNAME_COLUMN,
        self::SUPPORT_EMAIL_COLUMN,
        self::SHOPIFY_APP_SLUG_COLUMN,
    ];

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
