<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSisaPaguColumnIntoDetailPerjadinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_perjadin', function(Blueprint $table) {
            $table->double('sisa_pagu')->default(0)->after('jumlah_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_perjadin', function(Blueprint $table) {
            $table->dropColumn('sisa_pagu');
            });
    }
}
