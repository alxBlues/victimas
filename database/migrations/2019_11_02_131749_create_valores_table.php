<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('valor');
            $table->integer('tipo');
            $table->bigInteger('referencia_atributos')->unsigned();
            $table->foreign('referencia_atributos')->references('id')->on('atributos');
            $table->bigInteger('referencia_variables')->unsigned();
            $table->foreign('referencia_variables')->references('id')->on('variables');
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
        Schema::dropIfExists('valores');
    }
}
