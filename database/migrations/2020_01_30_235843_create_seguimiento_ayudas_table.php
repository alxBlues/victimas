<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoAyudasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_ayudas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_seguimiento');
            $table->string('motivo_desarrollo_de_la_intervencion',455);
            $table->string('acuerdos_observaciones',455);
            $table->string('url_adjunto');
            $table->bigInteger('persona_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('seguimiento_ayudas');
    }
}
