<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adicionar a CONTRAINT NOT NULL em todos os campos VARCHAR(32), quando possível.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cor', 32)->nullable(true);
            $table->string('color', 32)->nullable(true);;
            $table->string('couleur', 32)->nullable(true);
            $table->string('farbe', 32)->nullable(true);
            $table->string('colore', 32)->nullable(true);
            $table->string('tonalidad', 32)->nullable(true);
            $table->string('kleur', 32)->nullable(true);
            $table->string('hexadecimal', 6)->unique()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
}
