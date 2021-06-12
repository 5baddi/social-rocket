<?php

use BADDIServices\SocialRocket\Models\Earning;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEanrningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eanrnings', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('store_id');
            $table->uuid('subscription_id');
            $table->float('amount');
            $table->enum('status', Earning::STATUSES)->default(Earning::DEFAULT_STATUS);
            $table->timestamp('cancelled_on')->nullable();
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
        Schema::dropIfExists('eanrnings');
    }
}
