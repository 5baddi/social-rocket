<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Exceptions\Auth;

use Exception;
use Throwable;

class FailedToGenerateToken extends Exception
{
    /** @var int */
    public const CODE = 56;

    /** @var string */
    public const MESSAGE = "Failed to generate reset password token";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}