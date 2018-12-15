<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRkaklUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkakl_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('rkakl_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rkakl_id')->references('id')->on('rkakl');

            $table->primary(['user_id' , 'rkakl_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
