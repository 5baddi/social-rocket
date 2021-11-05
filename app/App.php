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

    public const DEFAULT_LOCALE = 'EN';
    public const ARABIC_LOCALE = 'AR';
    public const FRENCH_LOCALE = 'FR';
    public const DEFAULT_CURRENCY = 'USD';
    public const DEFAULT_CURRENCY_SYMBOL = '$';

    public const SUPPORTED_LOCALES = [
        self::DEFAULT_LOCALE,
        self::FRENCH_LOCALE,
        self::ARABIC_LOCALE,
    ];
}
