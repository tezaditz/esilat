<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyDetailPerkantoran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_perkantoran', function(Blueprint $table) {
            $table->integer('perkantoran_id')->unsigned()->after('sisa_pagu');
            $table->foreign('perkantoran_id')->references('id')->on('perkantoran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_perkantoran', function(Blueprint $table) {
            $table->dropColumn('perkantoran_id');
        });
    }
}