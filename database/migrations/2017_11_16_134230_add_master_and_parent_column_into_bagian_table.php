<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMasterAndParentColumnIntoBagianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bagian', function(Blueprint $table) {
            $table->integer('master')->nullable()->after('kode');
            $table->integer('parent')->nullable()->after('master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bagian', function(Blueprint $table) {
            $table->dropColumn('alasan');
        });
    }
}