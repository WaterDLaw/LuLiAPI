<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatFragebogen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
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
