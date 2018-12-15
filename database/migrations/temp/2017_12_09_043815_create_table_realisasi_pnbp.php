<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRealisasiPnbp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_pnbp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eselon_id')->nullable();
            $table->string('kode_satker')->nullable();
            $table->string('nama_satker')->nullable();
            $table->double('alokasi_rm')->nullable();
            $table->double('alokasi_pnbp')->nullable();
            $table->double('rm')->nullable();
            $table->double('pnbp')->nullable();
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
        Schema::dropIfExists('realisasi_pnbp');
    }
}
