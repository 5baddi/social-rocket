<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Entities\ModelEntity;

class AppSetting extends ModelEntity
{
    /** @var string */
    public const TABLE = 'app_settings';
    public const SUPPORT_EMAIL = 'support_email';
    public const INSTAGRAM_USERNAME = 'instagram_username';
    public const TWITTER_USERNAME = 'twitter_username';
    public const FACEBOOK_USERNAME = 'facebook_username';

    /** @var array */
    protected $fillable = [
        self::INSTAGRAM_USERNAME,
        self::TWITTER_USERNAME,
        self::FACEBOOK_USERNAME,
        self::SUPPORT_EMAIL,
    ];

    public function getFacebookUsername(): string
    {
        return "https://facebook.com/" . $this->getAttribute(self::FACEBOOK_USERNAME);
    }
    
    public function getTwitterUsername(): string
    {
        return "https://twitter.com/" . $this->getAttribute(self::TWITTER_USERNAME);
    }
    
    public function getInstagramUsername(): string
    {
        return "https://instagram.com/" . $this->getAttribute(self::INSTAGRAM_USERNAME);
    }
}
