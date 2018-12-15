<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEselonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_eselon', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('eselon_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('eselon_id')->references('id')->on('eselon');

            $table->primary(['user_id' , 'eselon_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_eselon');
    }
}
