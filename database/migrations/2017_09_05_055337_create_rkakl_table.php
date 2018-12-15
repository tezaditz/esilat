<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkaklTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkakl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_rkakl')->default(0);
            $table->string('kode')->nullable();
            $table->integer('level')->nullable();
            $table->integer('header')->default(0);
            $table->string('no_mak')->nullable();
            $table->string('no_mak_sys')->nullable();
            $table->text('uraian')->nullable();
            $table->double('vol')->default(0);
            $table->string('sat')->nullable();
            $table->double('hargasat')->default(0);
            $table->double('jumlah')->default(0);
            $table->double('realisasi')->default(0);
            $table->string('sdana')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('vol_pengajuan')->default(0);
            $table->double('realisasi_2')->default(0);
            $table->integer('vol_2')->default(0);
            $table->double('realisasi_3')->default(0);
            $table->integer('vol_3')->default(0);
            $table->integer('vol1')->default(0);
            $table->integer('vol2')->default(0);
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
        Schema::dropIfExists('rkakl');
    }
}
