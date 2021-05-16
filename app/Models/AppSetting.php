<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

class AppSetting extends Model
{
    /** @var string */
    public const INSTAGRAM_USERNAME = 'instagram_username';
    public const TWITTER_USERNAME = 'twitter_username';
    public const FACEBOOK_USERNAME = 'facebook_username';

    /** @var array */
    protected $fillable = [
        self::INSTAGRAM_USERNAME,
        self::TWITTER_USERNAME,
    ];
}
