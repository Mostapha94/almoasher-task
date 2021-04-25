<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150)->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->
            on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->text('description');
            $table->text('image')->nullable();
            $table->integer('rating')->default('0')->nullable();
            $table->integer('views')->default('0')->nullable();
            $table->enum('levels', ['beginner', 'immediat', 'high'])->nullable()->default('beginner');
            $table->integer('hours')->default('0')->nullable();
            $table->integer('active')->default('1')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
