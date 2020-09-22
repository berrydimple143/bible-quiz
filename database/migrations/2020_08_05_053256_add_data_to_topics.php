<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToTopics extends Migration
{
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('book', 70)->nullable()->default('');
            $table->string('chapter', 10)->nullable()->default('');
            $table->string('verse', 10)->nullable()->default('');
        });
    }
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn(['book']);
            $table->dropColumn(['chapter']);
            $table->dropColumn(['verse']);
        });
    }
}
