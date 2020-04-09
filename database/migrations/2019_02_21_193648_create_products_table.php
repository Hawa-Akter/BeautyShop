<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catId');
            $table->integer('brandId');
            $table->integer('subCatId');
            $table->text('slug');
            $table->string('productName');
            $table->string('productSerial',50)->unique();
            $table->string('productPrice');
            $table->string('discount')->default(0);
            $table->string('quantity');
            $table->string('productImage');
            $table->text('productDetails');
            $table->tinyInteger('status');
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('products');
    }
}
