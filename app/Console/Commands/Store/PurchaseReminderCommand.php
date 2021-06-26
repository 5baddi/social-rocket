<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands\Store;

use Throwable;
use Illuminate\Console\Command;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\SocialRocket\Services\StoreService;

class PurchaseReminderCommand extends Command
{
    /** @var string */
    protected $signature = 'purchase:reminder';

    /** @var string */
    protected $description = 'Purchase Email reminder';

    /** @var StoreService */
    private $storeService;

    public function __construct(
        StoreService $storeService
    )
    {
        parent::__construct();

        $this->storeService = $storeService;
    }

    public function handle()
    {
        try {
            $this->info("Start stores purchase reminder");

            $this->storeService->iterateOnActiveStores(
                function (Collection $stores) {
                    $stores->map(function (Store $store) {
                        try {

                        } catch (Throwable $e) {
                            AppLogger::setStore($store ?? null)->error($e, 'command:purchase:reminder');
                        }
                    });
                } 
            );

            $this->info("Done stores purchase reminder");
        } catch (Throwable $e) {
            AppLogger::error($e, 'command:purchase:reminder');
            $this->error(sprintf("Error while sending stores purchase reminder %s", $e->getMessage()));

            return;
        }
    }
}
