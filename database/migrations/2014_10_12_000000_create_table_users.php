<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable($value = true);
            $table->string('password',255);
            $table->rememberToken()->nullable($value = true);
            $table->integer('admin')->nullable($value = true)->default(0);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
