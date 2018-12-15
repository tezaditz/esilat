<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDokPerkantoran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dok_perkantoran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_dokumen')->nullable();
            $table->integer('ada')->default(0);

            $table->integer('perkantoran_id')->unsigned();
            $table->foreign('perkantoran_id')->references('id')->on('perkantoran');
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
    }
}
