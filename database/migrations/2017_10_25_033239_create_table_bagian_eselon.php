<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBagianEselon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagian_eselon', function (Blueprint $table) {
            $table->integer('bagian_id')->unsigned();
            $table->integer('eselon_id')->unsigned();

            $table->foreign('bagian_id')->references('id')->on('bagian');
            $table->foreign('eselon_id')->references('id')->on('eselon');

            $table->primary(['bagian_id' , 'eselon_id']);
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
