<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysKabkotaToPerjadinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perjadin', function (Blueprint $table) {
            $table->integer('kabkota_id')->unsigned()->after('prov_asal');
            $table->foreign('kabkota_id')->references('id')->on('kabkota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perjadin', function (Blueprint $table) {
            $table->dropColumn('kabkota_id');
        });
    }
}