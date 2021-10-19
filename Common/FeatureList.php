<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common;

class FeatureList
{
    public const CACHE = 'cache';
    public const HCAPTCHA = 'hcaptcha';
    public const OAUTH = 'oauth';

    public static function all(): array
    {
        return (new \ReflectionClass(__CLASS__))->getConstants();
    }
}
