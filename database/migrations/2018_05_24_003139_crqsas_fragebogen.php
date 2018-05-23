<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrqsasFragebogen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crq_sas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('erstellungsdatum')->nullable();
            $table->tinyInteger('frage_1')->nullable();
            $table->tinyInteger('frage_2')->nullable();
            $table->tinyInteger('frage_3')->nullable();
            $table->tinyInteger('frage_4')->nullable();
            $table->tinyInteger('frage_5')->nullable();
            $table->tinyInteger('frage_6')->nullable();
            $table->tinyInteger('frage_7')->nullable();
            $table->tinyInteger('frage_8')->nullable();
            $table->tinyInteger('frage_9')->nullable();
            $table->tinyInteger('frage_10')->nullable();
            $table->tinyInteger('frage_11')->nullable();
            $table->tinyInteger('frage_12')->nullable();
            $table->tinyInteger('frage_13')->nullable();
            $table->tinyInteger('frage_14')->nullable();
            $table->tinyInteger('frage_15')->nullable();
            $table->tinyInteger('frage_16')->nullable();
            $table->tinyInteger('frage_17')->nullable();
            $table->tinyInteger('frage_18')->nullable();
            $table->tinyInteger('frage_19')->nullable();
            $table->tinyInteger('frage_20')->nullable();
            $table->tinyInteger('gesamtpunktzahl')->nullable();
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
