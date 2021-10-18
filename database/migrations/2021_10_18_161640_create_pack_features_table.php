<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_features', function (Blueprint $table) {
            $table->uuid('pack_id');
            $table->uuid('feature_id');
            $table->json('value')->nullable();
            $table->tinyInteger('sort_order')->nullable();
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
        Schema::dropIfExists('pack_features');
    }
}
