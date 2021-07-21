<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands\Store;

use BADDIServices\ClnkGO\Logger;
use Throwable;
use Illuminate\Console\Command;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\ClnkGO\Models\Setting;
use BADDIServices\ClnkGO\Services\StoreService;

class PurchaseReminderCommand extends Command
{
    /** @var string */
    protected $signature = 'purchase:reminder';

    /** @var string */
    protected $description = 'Purchase Email reminder';

    /** @var Logger */
    private $logger;

    /** @var StoreService */
    private $storeService;

    public function __construct(
        Logger $logger,
        StoreService $storeService
    )
    {
        parent::__construct();

        $this->logger = $logger;
        $this->storeService = $storeService;
    }

    public function handle()
    {
        $this->info("Start stores purchase reminder");
        $startTime = microtime(true);

        try {
            $this->storeService->iterateOnActiveStores(
                function (Collection $stores) {
                    $stores->map(function (Store $store) {
                        try {
                            $store->load('setting');

                            /** @var Setting */
                            $setting = $store->setting;

                            //purchase_mail_24h purchase_mail_48h purchase_mail_120h
                        } catch (Throwable $e) {
                            $this->logger->setStore($store ?? null)->error($e, 'command:purchase:reminder');
                        }
                    });
                } 
            );
        } catch (Throwable $e) {
            $this->logger->error($e, 'command:purchase:reminder', ['execution_time' => (microtime(true) - $startTime)]);
            $this->error(sprintf("Error while sending stores purchase reminder %s", $e->getMessage()));

            return;
        }

        $this->info("Done stores purchase reminder");
    }
}
