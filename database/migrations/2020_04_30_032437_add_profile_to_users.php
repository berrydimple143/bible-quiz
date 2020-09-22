<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('description', 254)->nullable();
            $table->string('website', 254)->nullable();
            $table->string('facebook', 254)->nullable();
            $table->string('twitter', 254)->nullable();
            $table->string('linkedin', 254)->nullable();
            $table->string('portfolio', 254)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['description']);
            $table->dropColumn(['website']);
            $table->dropColumn(['facebook']);
            $table->dropColumn(['twitter']);
            $table->dropColumn(['linkedin']);
            $table->dropColumn(['portfolio']);
        });
    }
}
