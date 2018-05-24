<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ARPFeedbackFragebogen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arp_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->tinyInteger('frage_1')->nullable();
            $table->string('frage_1_bemerkungen')->nullable();
            $table->tinyInteger('frage_2')->nullable();
            $table->string('frage_2_bemerkungen')->nullable();
            $table->tinyInteger('frage_3')->nullable();
            $table->string('frage_3_bemerkungen')->nullable();
            $table->tinyInteger('frage_4_a')->nullable();
            $table->tinyInteger('frage_4_b')->nullable();
            $table->tinyInteger('frage_4_c')->nullable();
            $table->tinyInteger('frage_4_d')->nullable();
            $table->tinyInteger('frage_4_e')->nullable();
            $table->string('frage_4_bemerkungen')->nullable();
            $table->tinyInteger('frage_5_a')->nullable();
            $table->tinyInteger('frage_5_b')->nullable();
            $table->tinyInteger('frage_5_c')->nullable();
            $table->tinyInteger('frage_5_d')->nullable();
            $table->tinyInteger('frage_5_e')->nullable();
            $table->tinyInteger('frage_5_f')->nullable();
            $table->tinyInteger('frage_5_g')->nullable();
            $table->tinyInteger('frage_5_h')->nullable();
            $table->tinyInteger('frage_5_i')->nullable();
            $table->tinyInteger('frage_5_j')->nullable();
            $table->tinyInteger('frage_5_k')->nullable();
            $table->tinyInteger('frage_5_l')->nullable();
            $table->tinyInteger('frage_5_m')->nullable();
            $table->tinyInteger('frage_5_n')->nullable();
            $table->tinyInteger('frage_5_o')->nullable();
            $table->string('frage_5_bemerkungen')->nullable();
            $table->tinyInteger('frage_6_a')->nullable();
            $table->tinyInteger('frage_6_b')->nullable();
            $table->tinyInteger('frage_6_c')->nullable();
            $table->tinyInteger('frage_6_d')->nullable();
            $table->tinyInteger('frage_6_e')->nullable();
            $table->string('frage_6_bemerkungen')->nullable();
            $table->tinyInteger('frage_7')->nullable();
            $table->string('frage_7_bemerkungen')->nullable();
            $table->tinyInteger('frage_8')->nullable();
            $table->tinyInteger('frage_9')->nullable();
            $table->tinyInteger('frage_9_bemerkungen')->nullable();
            $table->string('allgemein')->nullable();
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
