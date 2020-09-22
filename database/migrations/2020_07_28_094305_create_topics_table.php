<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 254);
            $table->string('visible', 10)->nullable()->default('yes');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
