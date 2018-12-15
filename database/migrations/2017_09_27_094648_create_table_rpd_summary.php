<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRpdSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rpdsummary', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun_ang')->nullable();
            $table->string('bulan')->nullable();
            $table->decimal('nilai', 10,2)->default(0);
            $table->decimal('realisasi', 10,2)->nullable();
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
