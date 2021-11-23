<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket;

class App
{
    public const CHUNK_SIZE = 1000;

    public const DEFAULT_LOCALE = 'en';
    public const ARABIC_LOCALE = 'ar';
    public const FRENCH_LOCALE = 'fr';
    public const DEFAULT_CURRENCY = 'USD';
    public const DEFAULT_CURRENCY_SYMBOL = '$';

    public const SUPPORTED_LOCALES = [
        self::DEFAULT_LOCALE,
        // self::FRENCH_LOCALE,
        // self::ARABIC_LOCALE,
    ];
}
