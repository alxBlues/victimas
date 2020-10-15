<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionPsicosocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencion_psicosocials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechaAtencion');
            $table->string('entidad');
            $table->string('tipoIntervencion');
            //Datos de la persona
            $table->string('municipio');
            $table->string('barrio');
            $table->string('direccion');
            $table->string('tiempoResidencia');
            $table->string('telefono');
            $table->string('nombreContacto');
            $table->string('telContacto');
            $table->bigInteger('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
            // EVENTOS DE DESPLAZAMIENTO
            $table->string('departamentoD');
            $table->string('municipioD');
            $table->string('barrioD');
            $table->string('tiempoResidenciaD');
            $table->date('fechaDesplazamiento');
            $table->date('fechaDeclaracion');
            $table->date('fechaInclusion');
            // HECHOS VICTIMIZANTES
            $table->string('hechoVictimizante');
            // TENENCIA
            $table->string('tipoVivienda');
            $table->string('tipoFamilia');

            // RIESGOS PSICOSOCIALES
            $table->integer('duelos')->nullable();
            $table->integer('violenciaI')->nullable();
            $table->integer('conflictoPareja')->nullable();
            $table->integer('violenciaG')->nullable();
            $table->integer('maltratoI')->nullable();
            $table->integer('violenciaS')->nullable();
            $table->integer('transtornoP')->nullable();
            $table->integer('dificultadesA')->nullable();
            $table->integer('otro')->nullable();
            $table->string('cual')->nullable();
            $table->integer('ninguno')->nullable();
            //TRAZABILIDAD
            //CREATE
            $table->bigInteger('user_create_id')->unsigned();
            $table->foreign('user_create_id')->references('id')->on('users');
            //UPDATE
            $table->bigInteger('user_update_id')->unsigned();
            $table->foreign('user_update_id')->references('id')->on('users');
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
        Schema::dropIfExists('atencion_psicosocials');
    }
}
