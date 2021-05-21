<?php

use BADDIServices\SocialRocket\Models\Commission;
use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->uuid('id')->unqiue()->primary();
            $table->uuid('store_id');
            $table->uuid('order_id');
            $table->bigInteger('affiliate_id');
            $table->float('amount');
            $table->enum('status', Commission::STATUSES)->default(Commission::DEFAULT_STATUS);
            $table->string('payout_reference')->nullable();
            $table->enum('payout_method', Setting::PAYOUT_METHODS)->nullable();
            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('commissions');
    }
}
