<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('purchase_mail')->default(true)->after('thankyou_page');
            $table->boolean('purchase_mail_24h')->default(false)->after('purchase_mail');
            $table->boolean('purchase_mail_48h')->default(false)->after('purchase_mail_24h');
            $table->boolean('purchase_mail_120h')->default(false)->after('purchase_mail_48h');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('purchase_mail');
            $table->dropColumn('purchase_mail_24h');
            $table->dropColumn('purchase_mail_48h');
            $table->dropColumn('purchase_mail_120h');
        });
    }
}
