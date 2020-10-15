<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('titulo');
            $table->integer('nivel');
            $table->integer('tipo');
            $table->text('valor');
            $table->bigInteger('referencia_id')->unsigned();
            $table->foreign('referencia_id')->references('id')->on('atributos');
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
        Schema::dropIfExists('atributos');
    }
}
