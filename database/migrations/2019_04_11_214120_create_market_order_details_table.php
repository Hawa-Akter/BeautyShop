<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('owner_id');
            $table->integer('product_id');
            $table->float('net_price',8,2);
            $table->integer('quantity');
            $table->integer('product_discount');
            $table->float('total_amount',10,2);
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
        Schema::dropIfExists('market_order_details');
    }
}
