<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tipoDocumento')->nullable();
            $table->string('documento')->nullable();
            $table->string('lugarExpedicionDocumento')->nullable();
            $table->string('movil')->nullable();
            $table->string('direcion')->nullable();
            $table->string('dependencia')->nullable();
            $table->string('tipoContrato')->nullable();
            $table->string('finContrato')->nullable();
            $table->string('copiaContrato')->nullable();
            $table->string('estado')->nullable();
            $table->string('acepConfidencialidad')->nullable();
            $table->string('yaCargoInfoUser')->nullable();
            $table->date('acepConfidencialidadDate')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::unprepared("DROP PROCEDURE `validaUserComplet`; 
CREATE DEFINER=`root`@`localhost` PROCEDURE `validaUserComplet`(IN `id_user` INT) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER 
BEGIN 
set @validate =(SELECT `id` FROM `users` WHERE `id` = id_user AND `name` != '' AND `tipoDocumento` != '' AND `documento` != '' AND `dependencia` != '' AND `tipoContrato` != '' AND `finContrato` != '' AND `acepConfidencialidad` != '' AND `copiaContrato` != ''); 
IF @validate IS NULL THEN 
SELECT 'false' AS respuesta; 
ELSE 
SELECT 'true' AS respuesta; 
UPDATE `users` SET `yaCargoInfoUser` = '1' WHERE `users`.`id` = id_user; 
END IF; 
END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
