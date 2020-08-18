<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAbschlussDateToPatients extends Migration
{
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
            $table->date('abschlussDate')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
            $table->dropColumn('abschlussDate');

        });
    }
}
