<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManipulatesTable extends Migration
{
    public function up()
    {
        Schema::create('manipulates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('format', 30);
            $table->string('width', 10)->nullable()->default('');
            $table->string('height', 10)->nullable()->default('');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('manipulates');
    }
}
