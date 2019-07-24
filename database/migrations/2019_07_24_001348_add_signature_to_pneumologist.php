<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignatureToPneumologist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pneumologists', function (Blueprint $table) {
            //
            $table->string('signature')->nullable();
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pneumologists', function (Blueprint $table) {
            //
            $table->dropColumn('signature');
  
        });
    }
}
