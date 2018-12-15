<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPjTransportIntoDataPerjadinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('data_perjadin', function(Blueprint $table) {
            $table->double('pj_transport')->default(0)->after('pj_uang_harian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('data_perjadin', function(Blueprint $table) {
            $table->dropColumn('pj_transport');
            });
    }
}
