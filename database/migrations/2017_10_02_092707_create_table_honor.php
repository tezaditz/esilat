<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHonor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('honor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_mak')->nullable();
            $table->string('judul')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('no_pengajuan')->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->double('jml_pengajuan')->nullable();
            $table->date('tahun_anggaran')->nullable();
            $table->text('alasan')->nullable();
            $table->string('metode')->nullable();
            $table->date('tgl_awal')->nullable();
            $table->date('tgl_akhir')->nullable();

            $table->integer('bagian_id')->unsigned();
            $table->foreign('bagian_id')->references('id')->on('bagian');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
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
        Schema::dropIfExists('honor');
    }
}
