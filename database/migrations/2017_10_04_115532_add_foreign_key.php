<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kegiatan', function(Blueprint $table) {
            $table->integer('status_id')->unsigned()->after('total_realisasi');
            $table->foreign('status_id')->references('id')->on('status');
            $table->integer('metode_bayar_id')->unsigned()->after('status_id');
            $table->foreign('metode_bayar_id')->references('id')->on('metode_bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kegiatan', function(Blueprint $table) {
            $table->dropColumn('status_id');
            $table->dropColumn('metode_bayar_id');
        });
    }
}
