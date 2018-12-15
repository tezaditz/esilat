<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVolPesertaToPerjadinakun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('perjadin_akun', function (Blueprint $table) {
            $table->integer('jumlah_pelaksana')->default(0)->after('keterangan');
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
        Schema::table('perjadin_akun', function (Blueprint $table) {
            $table->dropColumn('jumlah_pelaksana');
        });
    }
}
