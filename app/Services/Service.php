<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Services;

use BADDIServices\ClnkGO\Logger;

class Service
{
    /** @var Logger */
    protected $logger;

    public function __construct()
    {
        /** @var Logger */
        $this->logger = app(Logger::class);
    }
}
