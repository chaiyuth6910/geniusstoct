<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('fullname',128);
            $table->string('email',64)->unique();
            $table->string('password',64);
            $table->string('tel',16)->nullable();
            $table->integer('gender');
            $table->date('birthdate')->nullable();
            $table->string('picprofile',64)->nullable();
            $table->integer('department');
            $table->string('isAdmin')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
