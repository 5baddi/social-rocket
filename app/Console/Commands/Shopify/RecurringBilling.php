<?php

namespace App\Console\Commands\Shopify;

use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Services\SubscriptionService;
use Illuminate\Console\Command;
use Throwable;

class RecurringBilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:get-paid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get paid for Shopify usage subscriptions';

    /** @var SubscriptionService */
    private $subscriptionService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        parent::__construct();

        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $subscriptions = $this->subscriptionService->getUsageBills();

            // TODO: to be impelement
        } catch (Throwable $ex) {
            AppLogger::error($ex, null, 'command:shopify-get-paid');

            return 0;
        }
    }
}
