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
            $table->tinyInteger('groesse');
            $table->enum('geschlecht', ['m','w']);
            $table->enum('sprache', ['DE','FR','IT','EN']);
            $table->integer('telefon');
            $table->string('strasse');
            $table->smallInteger('plz');
            $table->string('wohnort');
            $table->boolean('chronisch_obstruktive_Lungenkrankheit');
            $table->boolean('zystische_fibrose');
            $table->boolean('asthma_bronchiale');
            $table->boolean('interstitielle_lungenkrankheit');
            $table->boolean('thoraxwand_thoraxmuskelerkrankung');
            $table->boolean('andere_lungenkrankheit');
            $table->boolean('postoperative_lungenoperation');
            $table->boolean('funktionelle_atemstörung');
            $table->longtext('diagnose_details');
            $table->longtext('bemerkungen');
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
