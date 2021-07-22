<?php


/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Console;

use BADDIServices\ClnkGO\Logger;
use Illuminate\Console\Command as ConsoleCommand;

class Command extends ConsoleCommand
{
    /** @var Logger */
    protected $logger;

    public function __construct()
    {
        parent::__construct();

        /** @var Logger */
        $this->logger = app(Logger::class);
    }
}