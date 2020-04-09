<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeautitianProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beautitian_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('profession');
            $table->string('photo');
            $table->string('skill_one');
            $table->string('skill_two')->nullable();
            $table->string('skill_three')->nullable();
            $table->string('web_link')->nullable();
            $table->string('youtube_link')->nullable();
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
        Schema::dropIfExists('beautitian_profiles');
    }
}
