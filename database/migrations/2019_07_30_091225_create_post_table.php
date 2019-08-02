<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);
            $table->string('title', 50)->nullable(false);
            $table->string('text', 500)->nullable();
            $table->string('image', 255)->nullable();
            $table->datetime('regist_date')->nullable(false);
            $table->datetime('update_date')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post');
    }
}
