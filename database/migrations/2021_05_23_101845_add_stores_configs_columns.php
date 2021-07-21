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
            $table->string('myshopify_domain')->unqiue()->nullable()->after('domain');
            $table->string('phone', 50)->nullable()->after('myshopify_domain');
            $table->string('country', 10)->nullable()->after('phone');
            $table->bigInteger('shop_id')->nullable()->after('country');
            $table->string('timezone')->nullable()->after('shop_id');
            $table->string('locale', 10)->nullable()->after('timezone');
            $table->string('currency', 10)->nullable()->after('locale');
            $table->string('currency_symbol', 10)->nullable()->after('currency');
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
            $table->dropColumn('shop_id');
            $table->dropColumn('timezone');
            $table->dropColumn('myshopify_domain');
            $table->dropColumn('locale');
            $table->dropColumn('currency');
            $table->dropColumn('currency_symbol');
        });
    }
}
