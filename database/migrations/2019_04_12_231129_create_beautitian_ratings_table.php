<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeautitianRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beautitian_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('beautitian_id');
            $table->float('rate',4,1);
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
        Schema::dropIfExists('beautitian_ratings');
    }
}
