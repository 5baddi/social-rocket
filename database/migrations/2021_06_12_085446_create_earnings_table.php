<?php

use BADDIServices\SocialRocket\Models\Earning;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('store_id');
            $table->uuid('subscription_id');
            $table->float('amount');
            $table->enum('status', Earning::STATUSES)->default(Earning::DEFAULT_STATUS);
            $table->timestamp('activated_on')->nullable();
            $table->timestamp('cancelled_on')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('earnings');
    }
}
