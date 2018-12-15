<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlasanColumnToPerkantoranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perkantoran', function(Blueprint $table) {
            $table->string('alasan')->nullable()->after('total_nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perkantoran', function(Blueprint $table) {
            $table->dropColumn('alasan');
        });
    }
}
