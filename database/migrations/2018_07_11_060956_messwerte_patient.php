<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MesswertePatient extends Migration
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
            $table->double('gewicht_before',8,2)->nullable();
            $table->double('gewicht_after',8,2)->nullable();
            $table->double('fevl_before', 8,2)->nullable();
            $table->double('fevl_after', 8,2)->nullable();
            $table->double('fevp_before', 8,2)->nullable();
            $table->double('fevp_after', 8,2)->nullable();
            $table->double('vkmaxl_before', 8,2)->nullable();
            $table->double('vkmaxl_after', 8,2)->nullable();
            $table->double('vkmaxp_before', 8,2)->nullable();
            $table->double('vkmaxp_after', 8,2)->nullable();
            $table->double('vo2max_before', 8,2)->nullable();
            $table->double('vo2max_after', 8,2)->nullable();
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
