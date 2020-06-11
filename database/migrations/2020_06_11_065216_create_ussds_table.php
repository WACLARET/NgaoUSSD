<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUssdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ussds', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('customeridnumber')->unique();
            $table->char('customermobilenumber');
            $table->char('loanproduct');
            $table->integer('loanamount');
            $table->char('loanterm');
            $table->char('customerfullnames');
            $table->char('loanapplicationdate');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ussds');
    }
}
