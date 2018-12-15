<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBagianRkakl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian_rkakl', function (Blueprint $table) {
            $table->integer('bagian_id')->unsigned();
            $table->integer('rkakl_id')->unsigned();

            $table->foreign('bagian_id')->references('id')->on('bagian');
            $table->foreign('rkakl_id')->references('id')->on('rkakl');

            $table->primary(['bagian_id' , 'rkakl_id']);
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
