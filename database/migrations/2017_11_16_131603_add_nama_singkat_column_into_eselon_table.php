<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNamaSingkatColumnIntoEselonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eselon', function(Blueprint $table) {
            $table->string('nama_singkat')->nullable()->after('nama_satker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eselon', function(Blueprint $table) {
            $table->dropColumn('nama_singkat');
        });
    }
}
