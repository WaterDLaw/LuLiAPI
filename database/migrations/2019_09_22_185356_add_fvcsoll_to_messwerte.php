<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFvcsollToMesswerte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messwertes', function (Blueprint $table) {
            //
            $table->decimal('fvc_soll_vor',12,8)->nullable();
            $table->decimal('fvc_soll_nach',12,8)->nullable();
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messwertes', function (Blueprint $table) {
            //
            $table->dropColumn('fvc_soll_vor');
            $table->dropColumn('fvc_soll_nach');
  
        });
    }
}
