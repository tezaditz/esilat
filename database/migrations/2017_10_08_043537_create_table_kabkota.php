<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKabkota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('kabkota', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();

            $table->integer('provinsi_id')->unsigned();
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
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
        Schema::dropIfExists('kabkota');
    }
}
