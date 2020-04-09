<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('shipping_id');
            $table->integer('payment_id');
            $table->string('total_order_cost');
            $table->text('status');
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
        Schema::dropIfExists('market_orders');
    }
}
