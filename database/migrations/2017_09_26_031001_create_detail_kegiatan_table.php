<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id')->unsigned();
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan');
            $table->integer('rkakl_id')->unsigned();
            $table->foreign('rkakl_id')->references('id')->on('rkakl');
            $table->integer('level')->nullable();
            $table->integer('header')->nullable();
            $table->string('akun')->nullable();
            $table->string('rincian_akun')->nullable();
            $table->string('uraian')->nullable();
            $table->double('vol1')->default(0);
            $table->double('vol2')->default(0);
            $table->string('satuan')->nullable();
            $table->double('hrgsat')->default(0);
            $table->double('jml_rph')->default(0);
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
            $table->double('sisa_pagu')->nullable();
            $table->integer('sptjbflag')->default(0);
            $table->string('kode_9')->nullable();
            $table->string('kode_4')->nullable();
            $table->string('kode_8')->nullable();
            $table->string('kode_6')->nullable();
            $table->string('kode_7')->nullable();
            $table->string('kode_11')->nullable();
            $table->string('kode_0')->nullable();
            $table->double('pj_vol1')->nullable();
            $table->double('pj_vol2')->nullable();
            $table->double('pj_hrgsat')->nullable();
            $table->double('pj_jml_rph')->nullable();
            $table->integer('jenis_kegiatan')->nullable();
            $table->integer('jenis_peserta')->nullable();
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
        Schema::dropIfExists('detail_kegiatan');
    }
}
