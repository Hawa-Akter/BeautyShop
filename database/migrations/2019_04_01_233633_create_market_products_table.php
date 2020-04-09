<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('user_id');
            $table->text('slug');
            $table->string('productName');
            $table->string('productOrigin');
            $table->string('productSerial',50)->unique();
            $table->string('productPrice');
            $table->string('discount')->default(0);
            $table->string('quantity');
            $table->string('productImage');
            $table->text('productDetails');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('market_products');
    }
}
