<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerjadinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_pengajuan')->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->integer('bagian_id')->unsigned();
            $table->foreign('bagian_id')->references('id')->on('bagian');
            $table->string('no_mak')->nullable();
            $table->integer('thn_anggaran')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('no_surat_tugas')->nullable();
            $table->date('tgl_surat_tugas')->nullable();
            $table->date('tgl_awal')->nullable();
            $table->date('tgl_akhir')->nullable();
            $table->integer('lama')->nullable();
            $table->string('prov_asal')->nullable();
            $table->integer('provinsi_id')->unsigned();
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
            $table->string('alasan')->nullable();
            $table->double('total_pengajuan')->default(0);
            $table->string('metode_bayar')->nullable();
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
        Schema::dropIfExists('perjadin');
    }
}