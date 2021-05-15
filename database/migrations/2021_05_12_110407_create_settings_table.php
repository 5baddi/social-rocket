<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->unqiue()->primary();
            $table->uuid('store_id');
            $table->string('brand_name')->nullable();
            $table->string('currency', 10)->default('USD');
            $table->enum('commission_type', Setting::COMMISSION_TYPES)->nullable(false);
            $table->float('commission_amount')->default(Setting::DFEAULT_COMMISSION);
            $table->enum('discount_type', Setting::DISCOUNT_TYPES)->nullable(false);
            $table->float('discount_amount')->default(Setting::DFEAULT_DISCOUNT);
            $table->enum('discount_format', array_keys(Setting::DISCOUNT_FORMATS))->nullable(false);
            $table->string('color', 10)->default(Setting::DEFAULT_COLOR);
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
        Schema::dropIfExists('settings');
    }
}
