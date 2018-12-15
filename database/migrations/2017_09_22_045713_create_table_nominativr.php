<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNominativr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('nominativ', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->integer('peserta_id')->unsigned();
            $table->string('nama_peserta')->nullable();
            $table->string('nip')->nullable();
            $table->string('gol')->nullable();
            $table->string('instansi')->nullable();
            $table->string('daerah_asal')->nullable();
            $table->string('prov_daerah_tujuan')->nullable();
            $table->string('kab_daerah_tujuan')->nullable();
            $table->date('tgl_berangkat')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->integer('lama')->nullable();
            $table->double('tiket_pesawat')->nullable();
            $table->double('transport')->nullable();
            $table->double('uang_harian')->nullable();
            $table->double('penginapan')->nullable();
            $table->integer('flag')->default(0);
            $table->integer('peserta')->nullable();
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
    }
}
