<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrainingMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('ort')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('montag_start')->nullable();
            $table->string('montag_end')->nullable();
            $table->string('dienstag_start')->nullable();
            $table->string('dienstag_end')->nullable();
            $table->string('mittwoch_start')->nullable();
            $table->string('mittwoch_end')->nullable();
            $table->string('donnerstag_start')->nullable();
            $table->string('donnerstag_end')->nullable();
            $table->string('freitag_start')->nullable();
            $table->string('freitag_end')->nullable();
            $table->string('samstag_start')->nullable();
            $table->string('samstag_end')->nullable();
            $table->string('sonntag_start')->nullable();
            $table->string('sonntag_end')->nullable();
            $table->boolean('CRQ_SAS_bogen')->nullable();
            $table->boolean('SF_36_bogen')->nullable();
            $table->boolean('CRDQ_bogen')->nullable();
            $table->boolean('gehtest_bogen')->nullable();
            $table->boolean('feedback_bogen')->nullable();
            $table->boolean('COPD_bogen')->nullable();
            $table->boolean('belegt')->nullable();

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
