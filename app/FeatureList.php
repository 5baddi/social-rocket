<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket;

class FeatureList
{
    public const CACHE = 'cache';
    public const HCAPTCHA = 'hcaptcha';
    public const MULTI_LANGUAGE = 'multi-language';

    public static function all(): array
    {
        return array_values(
            (new \ReflectionClass(__CLASS__))->getConstants()
        );
    }
}
