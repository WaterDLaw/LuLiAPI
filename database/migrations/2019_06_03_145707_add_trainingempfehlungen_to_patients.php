<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingempfehlungenToPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
            $table->Integer('belastung')->nullable();
            $table->Integer('sauerstoff_bei_belastung')->nullable();
            $table->decimal('sao2',9,8)->nullable();
            $table->boolean('Intervalltraining')->nullable();
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
        Schema::table('patients', function (Blueprint $table) {

            $table->dropColumn('belastung');
            $table->dropColumn('sauerstoff_bei_belastung');
            $table->dropColumn('sao2');
            $table->dropColumn('Intervalttraining');
        });
    }
}
