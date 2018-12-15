<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPerjadinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_perjadin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perjadin_id')->nullable();
            $table->string('pelaksana_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_pelaksana')->nullable();
            $table->double('penginapan')->default(0);
            $table->double('uang_harian')->default(0);
            $table->double('transport')->default(0);
            $table->double('pesawat')->default(0);
            $table->double('total')->default(0);
            $table->double('pj_penginapan')->default(0);
            $table->double('pj_uang_harian')->default(0);
            $table->double('pj_pesawat')->default(0);
            $table->double('taksi_provinsi')->default(0);
            $table->double('taksi_kab_kota')->default(0);
            $table->double('registration')->default(0);
            $table->double('pj_taksi_provinsi')->default(0);
            $table->double('pj_taksi_kab_kota')->default(0);
            $table->double('pj_registration')->default(0);
            $table->string('status_id')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('data_perjadin');
    }
}