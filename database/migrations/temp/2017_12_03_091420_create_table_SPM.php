<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSPM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                //
        Schema::create('SPM', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_spm');
            $table->date('tanggal_spm');
            $table->decimal('nilai_spm');
            $table->string('nomor_sp2d');
            $table->date('tanggal_sp2d');
            $table->decimal('nilai_sp2d');
            $table->integer('metode_bayar');
            $table->integer('status_spm');
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
        Schema::dropIfExists('SPM');
    }
}
