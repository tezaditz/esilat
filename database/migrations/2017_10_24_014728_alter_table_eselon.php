<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEselon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eselon', function (Blueprint $table) {
            if (!Schema::hasColumn('eselon', 'kode_satker')) {
                $table->string('kode_satker')->after('id');
            }

            if (!Schema::hasColumn('eselon', 'nama_satker')) {
                $table->string('nama_satker')->after('kode_satker');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eselon');
    }
}
