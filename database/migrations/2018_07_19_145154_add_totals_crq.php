<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalsCrq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crq_sas', function (Blueprint $table) {
            //
            $table->double('dyspnoe',8,2)->nullable();
            $table->double('fatique',8,2)->nullable();
            $table->double('emotion',8,2)->nullable();
            $table->double('mastery',8,2)->nullable();
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
