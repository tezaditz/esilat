<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilihAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilih_akun', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rkakl_id')->unsigned();
            $table->foreign('rkakl_id')->references('id')->on('rkakl');
            $table->integer('kegiatan_id')->unsigned();
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan');
            $table->integer('level')->nullable();
            $table->integer('header')->nullable();
            $table->integer('parent')->nullable();
            $table->string('kode')->nullable();
            $table->string('no_mak')->nullable();
            $table->string('no_mak_sys')->nullable();
            $table->text('uraian')->nullable();
            $table->integer('vol')->nullable();
            $table->string('sat')->nullable();
            $table->double('hargasat')->nullable();
            $table->double('jumlah')->nullable();
            $table->integer('vol1')->nullable();
            $table->integer('vol2')->nullable();
            $table->double('sisa_pagu')->nullable();
            $table->double('sisa_vol')->nullable();
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
        Schema::dropIfExists('pilih_akun');
    }
}