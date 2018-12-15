<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_pengajuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bagian_id')->unsigned();
            $table->integer('nomor')->nullable();
            $table->string('jenis')->nullable();
            $table->string('kode_transaksi')->nullable();
            $table->foreign('bagian_id')->references('id')->on('bagian');
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
        Schema::dropIfExists('no_pengajuan');
    }
}
