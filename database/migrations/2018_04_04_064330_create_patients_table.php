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
            $table->string('vorname')->nullable();;
            $table->string('name')->nullable();;
            $table->string('email')->nullable();;
            $table->date('geburtsdatum')->nullable();;
            $table->smallInteger('groesse')->nullable();;
            $table->enum('geschlecht', ['m','w'])->nullable();;
            $table->enum('sprache', ['DE','FR','IT','EN'])->nullable();;
            $table->integer('telefon')->nullable();;
            $table->string('strasse')->nullable();;
            $table->smallInteger('plz')->nullable();;
            $table->string('wohnort')->nullable();;
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
