<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->text('body')->nullable();
            $table->string('author', 100)->nullable();
            $table->string('published', 5)->default('no');
            $table->string('reported', 5)->default('no');
            $table->string('popular', 5)->default('no');
            $table->dateTime('date_posted')->nullable();
            $table->dateTime('date_expired')->nullable();
            $table->string('photo', 254)->nullable();
            $table->string('video', 254)->nullable();
            $table->integer('visit')->nullable()->default(0);
            $table->integer('click')->nullable()->default(0);
            $table->string('slug', 254)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 10)->nullable()->default('active');
            $table->string('posttype', 15)->nullable()->default('general');
            $table->integer('rating')->nullable()->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
