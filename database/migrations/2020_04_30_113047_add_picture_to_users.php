<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPictureToUsers extends Migration
{
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('picture', 254)->nullable();
        });
    }
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['picture']);
        });
    }
}
