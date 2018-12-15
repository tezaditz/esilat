<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePerkantoranDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_perkantoran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_mak_sys')->nullable();
            $table->string('uraian')->nullable();
            $table->double('vol')->default(0);
            $table->double('harga_satuan')->default(0);
            $table->double('jumlah')->default(0);
            $table->double('pj_jumlah')->default(0);
            $table->string('kode_9')->default(0);
            $table->string('kode_4')->default(0);
            $table->string('kode_8')->default(0);
            $table->string('kode_6')->default(0);
            $table->string('kode_7')->default(0);
            $table->string('kode_11')->default(0);
            $table->string('kode_0')->default(0);
            $table->double('sisa_pagu')->nullable();
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
        Schema::dropIfExists('detail_perkantoran');
    }
}
