<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eselon_id')->nullable();
            $table->string('no_kontrak');
            $table->date('tgl_kontrak');
            $table->integer('jenis_kontrak');
            $table->decimal('nilai_kontrak');
            $table->string('no_mak_sys');
            $table->string('jangka_waktu');
            $table->string('file_kontrak');
            $table->string('file_bapp');
            $table->string('file_bast');
            $table->string('file_bap');
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
        Schema::dropIfExists('kontrak');
    }
}
