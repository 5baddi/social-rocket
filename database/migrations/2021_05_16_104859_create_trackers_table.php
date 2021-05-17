<?php

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->uuid('id')->unqiue()->primary();
            $table->uuid('store_id');
            $table->bigInteger('order_id');
            $table->bigInteger('checkout_id');
            $table->bigInteger('customer_id');
            $table->string('name');
            $table->string('product_slug');
            $table->float('total_price');
            $table->float('total_price_usd');
            $table->string('currency', 10)->default(Setting::DEFAULT_CURRENCY);
            $table->float('total_price');
            $table->json('discount_codes')->nullable();
            $table->float('total_discounts');
            $table->boolean('confirmed')->default(false);
            $table->timestamp('cancelled_at')->nullable();
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
        Schema::dropIfExists('trackers');
    }
}
