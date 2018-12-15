<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRealisasiPengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_pengadaan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eselon_id')->nullable();
            $table->string('kode_satker')->nullable();
            $table->string('nama_satker')->nullable();
            $table->double('alokasi')->nullable();
            $table->double('nilai_kontrak')->nullable();
            $table->double('pencairan_kontrak')->nullable();
            $table->integer('tahun_ang')->nullable();
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
        Schema::dropIfExists('realisasi_pengadaan');
    }
}
