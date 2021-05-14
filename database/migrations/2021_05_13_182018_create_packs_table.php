<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use BADDIServices\SocialRocket\Models\Pack;
use Illuminate\Database\Migrations\Migration;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->uuid('id')->unqiue()->primary();
            $table->string('name', 100)->unique();
            $table->json('features')->nullable(true);
            $table->float('price')->default(0.0);
            $table->enum('price_type', Pack::PRICE_TYPES);
            $table->enum('payment_cycle', Pack::PAYMENT_CYCLES)->default(Pack::PER_MONTH);
            $table->integer('trial_days')->default(Pack::DEFAULT_TRIAL_DAYS);
            $table->boolean('is_popular')->default(false);
            $table->string('currency', 10)->default('usd');
            $table->string('currency_symbol', 10)->nullable();
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
        Schema::dropIfExists('packs');
    }
}
