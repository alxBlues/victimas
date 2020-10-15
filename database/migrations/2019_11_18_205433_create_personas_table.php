<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('evento');
            $table->string('lugar');
            $table->date('fechaAtencion');
            $table->string('primerNombre');
            $table->string('segundoNombre')->nullable();
            $table->string('primerApellido');
            $table->string('segundoApellido')->nullable();
            $table->string('tipoDoc');
            $table->integer('identificacion');
            $table->date('fechaNacimiento');
            $table->integer('edad');
            $table->string('grado');
            $table->integer('telefono');
			$table->tinyInteger('area');
			$table->string('estrato');
            $table->string('salud');
            $table->bigInteger('genero_id')->unsigned();
            $table->foreign('genero_id')->references('id')->on('generos');
            $table->bigInteger('tipoP_id')->unsigned();
            $table->foreign('tipoP_id')->references('id')->on('tipo_poblacions');
            $table->bigInteger('enfoqueP_id')->unsigned();
            $table->foreign('enfoqueP_id')->references('id')->on('enfoque_poblacionals');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('personas');
    }
}
