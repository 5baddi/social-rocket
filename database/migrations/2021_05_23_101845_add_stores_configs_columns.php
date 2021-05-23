<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoresConfigsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('name')->unqiue()->nullable()->after('id');
            $table->string('email')->nullable()->after('name');
            $table->string('domain')->unqiue()->nullable()->after('slug');
            $table->string('phone', 50)->nullable()->after('domain');
            $table->string('country', 10)->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('domain');
            $table->dropColumn('phone');
            $table->dropColumn('country');
        });
    }
}
