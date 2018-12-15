<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bagian_id')->unsigned();
            $table->foreign('bagian_id')->references('id')->on('bagian');
            $table->string('judul')->nullable();
            $table->string('tahun_anggaran')->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->string('no_mak')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->date('tgl_awal')->nullable();
            $table->date('tgl_akhir')->nullable();
            $table->integer('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotel');
            $table->integer('flag_pengajuan')->nullable();
            $table->integer('provinsi_id')->unsigned();
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->integer('no_pengajuan')->nullable();
            $table->string('no_pengajuan2')->nullable();
            $table->double('total_realisasi')->default(0);
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
        Schema::dropIfExists('kegiatan');
    }
}
