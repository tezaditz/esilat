<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rkakl_id')->unsigned();
            $table->foreign('rkakl_id')->references('id')->on('rkakl');
            $table->string('no_mak_sys')->nullable();
            $table->text('uraian')->nullable();
            $table->double('vol')->nullable();
            $table->string('sat')->nullable();
            $table->double('hargasat')->nullable();
            $table->double('jumlah')->nullable();
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
        //
        Schema::dropIfExists('pengadaan');
    }
}
