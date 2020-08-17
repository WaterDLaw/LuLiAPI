<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchulungenPatient extends Migration
{
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
            $table->boolean('schulung1')->nullable();
            $table->boolean('schulung2')->nullable();
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
            $table->dropColumn('schulung1');
            $table->dropColumn('schulung2');
        });
    }
}
