<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEselonRkakl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eselon_rkakl', function (Blueprint $table) {
            $table->integer('eselon_id')->unsigned();
            $table->integer('rkakl_id')->unsigned();

            $table->foreign('eselon_id')->references('id')->on('eselon');
            $table->foreign('rkakl_id')->references('id')->on('rkakl');

            $table->primary(['eselon_id' , 'rkakl_id']);
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
