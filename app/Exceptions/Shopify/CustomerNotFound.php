<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Exceptions\Shopify;

use Exception;
use Throwable;

class CustomerNotFound extends Exception
{
    /** @var int */
    public const CODE = 18;

    /** @var string */
    public const MESSAGE = "Customer not found";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}