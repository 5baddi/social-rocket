<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;
use BADDIServices\SocialRocket\AppLogger;

class PurchaseReminderCommand extends Command
{
    /** @var string */
    protected $signature = 'purchase:reminder';

    /** @var string */
    protected $description = 'Purchase Email reminder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            
        } catch (Throwable $e) {
            AppLogger::error($e, 'command:purchase:reminder');

            return;
        }
    }
}
