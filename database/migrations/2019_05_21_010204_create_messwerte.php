<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesswerte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('messwertes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('aktuell')->nullable();
            // Allgemeine Daten

            $table->decimal('groesse_vor',5,2)->nullable();
            $table->decimal('groesse_nach',5,2)->nullable();

            $table->decimal('gewicht_vor',5,2)->nullable();
            $table->decimal('gewicht_nach',5,2)->nullable();

            $table->decimal('bmi_vor',4,1)->nullable();
            $table->decimal('bmi_nach',4,1)->nullable();

            //Spirometrie

            $table->decimal('fev1l_vor',4,2)->nullable();
            $table->decimal('fev1l_nach',4,2)->nullable();

            $table->decimal('fev1soll_vor',9,8)->nullable();
            $table->decimal('fev1soll_nach',9,8)->nullable();

            $table->decimal('fvc_vor',5,2)->nullable();
            $table->decimal('fvc_nach',5,2)->nullable();

            $table->decimal('fev1_fvc_vor',9,8)->nullable();
            $table->decimal('fev1_fvc_nach',9,8)->nullable();

            $table->decimal('rv_vor',5,2)->nullable();            
            $table->decimal('rv_nach',5,2)->nullable();

            $table->decimal('tlc_vor',5,2)->nullable();
            $table->decimal('tlc_nach',5,2)->nullable();

            $table->decimal('rv_tlc_vor',9,8)->nullable();
            $table->decimal('rv_tlc_nach',9,8)->nullable();

            // Arterielle Blutgase

            $table->decimal('O2_Dosis_vor',5,2)->nullable();
            $table->decimal('O2_Dosis_nach',5,2)->nullable();

            $table->decimal('saO2_vor',9,8)->nullable();
            $table->decimal('saO2_nach',9,8)->nullable();

            $table->decimal('phwert_vor',4,2)->nullable();
            $table->decimal('phwert_nach',4,2)->nullable();

            $table->decimal('pO2_vor',5,2)->nullable();
            $table->decimal('pO2_nach',5,2)->nullable();

            $table->decimal('pC02_vor',5,2)->nullable();
            $table->decimal('pC02_nach',5,2)->nullable();

            $table->decimal('bicarbonat_vor',5,2)->nullable();
            $table->decimal('bicarbonat_nach',5,2)->nullable();

            // Belastung

            $table->decimal('max_leistungW_vor',5,2)->nullable();
            $table->decimal('max_leistungW_nach',5,2)->nullable();

            $table->decimal('max_leistungS_vor',9,8)->nullable();
            $table->decimal('max_leistungS_nach',9,8)->nullable();

            $table->decimal('vO2max_vor',5,1)->nullable();
            $table->decimal('vO2max_nach',5,1)->nullable();

            $table->decimal('hfmax_vor',5,2)->nullable();
            $table->decimal('hfmax_nach',5,2)->nullable();

            $table->unsignedInteger('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            
            // 6 Minuten Gehtest
            $table->integer('distanzM_vor')->nullable();
            $table->integer('distanzM_nach')->nullable();

            $table->decimal('distanzS_vor',9,8)->nullable();
            $table->decimal('distanzS_nach',9,8)->nullable();

            
            $table->decimal('saO2min_vor',9,8)->nullable();
            $table->decimal('saO2min_nach',9,8)->nullable();

            // Dsyopnoe 

            $table->string('dyspnoe_vor')->nullable();
            $table->string('dyspnoe_nach')->nullable();

            // Bodescore
            $table->tinyInteger('bodescore_vor')->nullable();
            $table->tinyInteger('bodescore_nach')->nullable();
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
