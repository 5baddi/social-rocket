<?php

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
            $table->string('slug');
            $table->string('name');
            $table->string('email');
            $table->string('shopify_domain');
            $table->string('domain')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('city')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('locale', 10)->nullable();
            $table->string('currency', 10)->nullable();
            $table->tinyInteger('checkout_api_supported')->default(0);
            $table->tinyInteger('is_main_shop')->default(0);
            $table->tinyInteger('enabled')->default(0);
            $table->timestamp('connected_at')->nullable();
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
