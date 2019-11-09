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
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('userid')->nullable();
            $table->string('password')->nullable();
            $table->string('telegram_userid')->nullable();
            $table->string('telegram_username')->nullable();
            $table->string('telegram_firstname')->nullable();
            $table->string('telegram_lastname')->nullable();
            $table->dateTime('telegram_lastinfoupdate')->nullable();
            $table->string('phone')->nullable();
            $table->rememberToken()->nullable();
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
