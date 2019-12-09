<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRrToMesswerte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messwertes', function (Blueprint $table) {
            //
            $table->tinyInteger('trainingspuls')->nullable();
            $table->decimal('rr_syst_vor',5,2)->nullable();
            $table->decimal('rr_syst_nach',5,2)->nullable();
            $table->decimal('rr_diast_vor',5,2)->nullable();
            $table->decimal('rr_diast_nach',5,2)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //$table->dropColumn('password');
        Schema::table('messwertes', function (Blueprint $table) {
            //
            $table->dropColumn('trainingspuls');
            $table->dropColumn('rr_syst_vor');
            $table->dropColumn('rr_syst_nach');
            $table->dropColumn('rr_diast_vor');
            $table->dropColumn('rr_diast_nach');
        });
    }
}
