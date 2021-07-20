<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Exceptions\Shopify;

use Exception;
use Throwable;

class AcceptPaymentFailed extends Exception
{
    /** @var int */
    public const CODE = 57;

    /** @var string */
    public const MESSAGE = "Failed to redirect to payment acceptation link";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}