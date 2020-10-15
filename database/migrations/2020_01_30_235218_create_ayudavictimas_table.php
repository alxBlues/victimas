<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyudavictimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayudavictimas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('persona_id')->unsigned();
            $table->string('accion');
            $table->string('tipo');
            $table->string('ayudas')->nullable();
            $table->string('ids_ayudas')->nullable();
            $table->bigInteger('valor_ayudas')->nullable();
            $table->string('url_adjunto1')->nullable();
            $table->string('url_adjunto2')->nullable();
            $table->string('url_adjunto3')->nullable();
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('ayudavictimas');
    }
}
