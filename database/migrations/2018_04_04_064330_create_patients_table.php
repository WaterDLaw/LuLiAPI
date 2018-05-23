<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('vorname');
            $table->string('name');
            $table->string('email');
            $table->date('geburtsdatum');
            $table->smallInteger('groesse');
            $table->enum('geschlecht', ['m','w']);
            $table->enum('sprache', ['DE','FR','IT','EN']);
            $table->integer('telefon');
            $table->string('strasse');
            $table->smallInteger('plz');
            $table->string('wohnort');
            $table->boolean('chronisch_obstruktive_Lungenkrankheit')->nullable();
            $table->boolean('zystische_fibrose')->nullable();
            $table->boolean('asthma_bronchiale')->nullable();
            $table->boolean('interstitielle_lungenkrankheit')->nullable();
            $table->boolean('thoraxwand_thoraxmuskelerkrankung')->nullable();
            $table->boolean('andere_lungenkrankheit')->nullable();
            $table->boolean('postoperative_lungenoperation')->nullable();
            $table->boolean('funktionelle_atemstoerung')->nullable();
            $table->longtext('diagnose_details')->nullable();
            $table->longtext('bemerkungen')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
