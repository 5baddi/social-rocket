<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Exceptions\Shopify;

use Exception;
use Throwable;

class CancelSubscriptionFailed extends Exception
{
    /** @var int */
    public const CODE = 58;

    /** @var string */
    public const MESSAGE = "Failed to cancel subscription";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}