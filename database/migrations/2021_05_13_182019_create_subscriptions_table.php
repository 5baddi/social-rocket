<?php

use BADDIServices\SocialRocket\Models\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->unqiue()->primary();
            $table->uuid('user_id');
            $table->uuid('store_id');
            $table->uuid('pack_id');
            $table->enum('status', Subscription::STATUSES)->default(Subscription::DEFAULT_STATUS);
            $table->bigInteger('charge_id')->nullable();
            $table->bigInteger('usage_id')->nullable();
            $table->date('billing_on')->nullable();
            $table->date('activated_on')->nullable();
            $table->date('trial_ends_on')->nullable();
            $table->date('cancelled_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
