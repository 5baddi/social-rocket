<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Console\Commands\Store;

use Throwable;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\ClnkGO\Services\StoreService;
use BADDIServices\ClnkGO\Console\Command;

class PurchaseReminderCommand extends Command
{
    /** @var string */
    protected $signature = 'purchase:reminder';

    /** @var string */
    protected $description = 'Purchase Email reminder';

    /** @var StoreService */
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        parent::__construct();

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
