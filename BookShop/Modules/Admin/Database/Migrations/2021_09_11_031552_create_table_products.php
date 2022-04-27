<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('category_id')->index();
            $table->integer('user_id')->index();
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->string('content');
            $table->string('avatar_name');
            $table->string('avatar_path');
            $table->float('price');
            $table->integer('quantity');
            $table->integer('sold')->default(0);
            $table->tinyInteger('sale');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('hot')->default(0);
            $table->integer('view')->default(0);
            $table->string('keyword');
            $table->softDeletes();
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
        Schema::dropIfExists('');
    }
}
