<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_t')->nullable();
            $table->string('no_mak_sys')->nullable();
            $table->double('jumlah')->default(0);
            $table->double('vol')->default(0);
            $table->string('kode_9')->nullable();
            $table->string('kode_4')->nullable();
            $table->string('kode_8')->nullable();
            $table->string('kode_6')->nullable();
            $table->string('kode_7')->nullable();
            $table->string('kode_11')->nullable();
            $table->string('kode_0')->nullable();
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
