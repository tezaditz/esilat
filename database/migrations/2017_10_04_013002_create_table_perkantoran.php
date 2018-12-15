<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerkantoran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkantoran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_pengajuan')->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->string('no_mak')->nullable();
            $table->string('uraian')->nullable();
            $table->string('keterangan')->nullable();
            $table->double('total_nilai')->default(0);
            $table->string('metode')->nullable();
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
        Schema::dropIfExists('perkantoran');
    }
}
