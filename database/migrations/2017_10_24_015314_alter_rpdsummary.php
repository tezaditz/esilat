<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRpdsummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpdsummary', function (Blueprint $table) {
            if (!Schema::hasColumn('rpdsummary', 'nilai_perubahan'))
            {
                $table->decimal('nilai_perubahan', 10, 2)->after('nilai');
            }

            if (!Schema::hasColumn('rpdsummary', 'eselon_id'))
            {
                $table->integer('eselon_id')->after('nilai_perubahan');
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
        //
    }
}
