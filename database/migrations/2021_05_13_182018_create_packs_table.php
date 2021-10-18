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
            $table->string('name_key', 100)->unique();
            $table->float('price')->default(0.0);
            $table->float('revenue_share')->default(0.0);
            $table->tinyInteger('type')->nullable();
            $table->string('interval', 25);
            $table->integer('trial_days');
            $table->boolean('is_popular')->default(false);
            $table->string('currency', 10);
            $table->string('currency_symbol', 10)->nullable();
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
        Schema::dropIfExists('packs');
    }
}
