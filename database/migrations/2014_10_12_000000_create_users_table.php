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
            $table->bigIncrements('id');
            $table->string('firstname', 60);
            $table->string('lastname', 60);
            $table->string('middlename', 60)->nullable()->default('');
            $table->string('email', 60)->unique();
            $table->string('password', 255);
            $table->string('membership', 15)->nullable()->default('none');
            $table->string('ip', 20)->nullable()->default('');
            $table->string('status', 10);
            $table->dateTime('activated_at');
            $table->dateTime('expired_at');
            $table->integer('subscription')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
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
