<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPerjadinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_perjadin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perjadin_id')->unsigned();
            $table->foreign('perjadin_id')->references('id')->on('perjadin');
            $table->integer('data_perjadin_id')->unsigned();
            $table->foreign('data_perjadin_id')->references('id')->on('data_perjadin');
            $table->string('no_mak_sys')->nullable();
            $table->string('uraian')->nullable();
            $table->double('vol')->default(0);
            $table->double('jumlah')->default(0);
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
            $table->double('pj_jumlah')->default(0);
            $table->string('kode_9')->nullable();
            $table->string('kode_8')->nullable();
            $table->string('kode_4')->nullable();
            $table->string('kode_6')->nullable();
            $table->string('kode_7')->nullable();
            $table->string('kode_11')->nullable();
            $table->string('kode_0')->nullable();
            $table->double('jumlah_pengajuan')->default(0);
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
        Schema::dropIfExists('detail_perjadin');
    }
}