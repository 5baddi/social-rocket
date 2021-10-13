<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('name')->unqiue()->nullable();
            $table->string('slug')->unique();
            $table->string('email')->nullable();
            $table->string('domain')->unqiue()->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('country', 10)->nullable();
            $table->timestamp('connected_at')->nullable();
            $table->tinyInteger('is_main_shop')->default(0);
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('shops');
    }
}
