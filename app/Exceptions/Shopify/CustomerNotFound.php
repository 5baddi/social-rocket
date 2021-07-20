<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Exceptions\Shopify;

use Exception;
use Throwable;

class CustomerNotFound extends Exception
{
    /** @var int */
    public const CODE = 62;

    /** @var string */
    public const MESSAGE = "Customer not found";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}