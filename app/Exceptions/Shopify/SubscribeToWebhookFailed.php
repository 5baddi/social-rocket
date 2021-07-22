<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Exceptions\Shopify;

use Exception;
use Throwable;

class SubscribeToWebhookFailed extends Exception
{
    /** @var int */
    public const CODE = 71;

    /** @var string */
    public const MESSAGE = "Failed during subscribe to %s webhook";

    public function __construct(string $webhookTopic, int $code = self::CODE, Throwable $previous = null)
    {
        parent::__construct(
            sprintf(self::MESSAGE, $webhookTopic), 
            $code, 
            $previous
        );
    }
}