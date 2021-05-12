<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Exceptions\Shopify;

use Exception;
use Throwable;

class InvalidStoreURLException extends Exception
{
    /** @var int */
    public const INVALID_STORE_URL = 11;

    /** @var string */
    public const INVALID_STORE_URL_MESSAGE = "Store URL is invalid";

    public function __construct(string $message = self::INVALID_STORE_URL_MESSAGE, int $code = self::INVALID_STORE_URL, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}