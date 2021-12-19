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
    public const CODE = 67;

    /** @var string */
    public const MESSAGE = "Store URL is invalid";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}