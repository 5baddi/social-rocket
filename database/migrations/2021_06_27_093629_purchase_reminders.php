<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaseReminders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_reminders', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('store_id');
            $table->uuid('user_id');
            $table->boolean('mail_24h_sent')->default(false);
            $table->boolean('mail_48h_sent')->default(false);
            $table->boolean('mail_120h_sent')->default(false);
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
        Schema::dropIfExists('purchase_reminders');
    }
}
