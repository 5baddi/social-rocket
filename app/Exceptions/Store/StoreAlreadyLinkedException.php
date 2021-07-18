<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Exceptions\Store;

use Exception;
use Throwable;

class StoreAlreadyLinkedException extends Exception
{
    /** @var int */
    public const CODE = 55;

    /** @var string */
    public const MESSAGE = "Store already linked to another account";

    public function __construct(string $message = self::MESSAGE, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}