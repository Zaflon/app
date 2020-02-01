<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('difficulty_id');
            $table->unsignedBigInteger('type_id');
            $table->string('todo', 255);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('persons');
            $table->foreign('difficulty_id')->references('id')->on('persons');
            $table->foreign('type_id')->references('id')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
