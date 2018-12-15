<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpd', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rkakl_id')->unsigned();
            $table->foreign('rkakl_id')->references('id')->on('rkakl');
            $table->integer('level')->nullable();
            $table->string('kode')->nullable();
            $table->string('no_mak')->nullable();
            $table->string('no_mak_sys')->nullable();
            $table->double('pagu')->nullable();
            $table->string('uraian')->nullable();
            $table->integer('bagian_id')->unsigned();
            $table->foreign('bagian_id')->references('id')->on('bagian');
            $table->double('jan')->default(0);
            $table->double('feb')->default(0);
            $table->double('mar')->default(0);
            $table->double('apr')->default(0);
            $table->double('mei')->default(0);
            $table->double('jun')->default(0);
            $table->double('jul')->default(0);
            $table->double('ags')->default(0);
            $table->double('sep')->default(0);
            $table->double('okt')->default(0);
            $table->double('nov')->default(0);
            $table->double('des')->default(0);
            $table->integer('thn_ang')->nullable();
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
        Schema::dropIfExists('rpd');
    }
}