<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHechoVictimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hecho_victimas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hechoV_id')->unsigned();
            $table->foreign('hechoV_id')->references('id')->on('hecho_victimizantes');
            $table->bigInteger('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
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
        Schema::dropIfExists('hecho_victimas');
    }
}
