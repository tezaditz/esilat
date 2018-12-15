<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSp2dsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sas_sp2d', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_sp2d');
            $table->date('tgl_selesai_sp2d');
            $table->date('tgl_sp2d');
            $table->double('nilai_sp2d');
            $table->string('nomor_invoice');
            $table->date('tgl_invoice');
            $table->string('jenis_spm');
            $table->string('jenis_sp2d');
            $table->string('deskripsi');
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
        Schema::dropIfExists('sas_sp2d');
    }
}
