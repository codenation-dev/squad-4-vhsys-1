<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level',255);
            $table->string('log',500);
            $table->string('eventos',255);
            $table->integer('id_user_cad')->unsigned();
            $table->timestamps();
            $table->foreign('id_user_cad')->references('id')->on('users');
            $table->integer('id_user_alteracao')->nullable($value = true);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
