<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Beneficiario extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
  protected $fillable = [
        'id','persona_id', 'primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'tipoDoc', 'documento', 'fechaNacimiento', 'genero_id', 'estaCivil',
        'relacion', 'enfoqueP_id', 'afiSalud', 'grado', 'estudia', 'leerEscribir', 'SNprograma', 'programa', 'user_create_id', 'user_update_id',
    ];
    
    protected $auditInclude = [
        'id','persona_id', 'primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'tipoDoc', 'documento', 'fechaNacimiento', 'genero_id', 'estaCivil',
        'relacion', 'enfoqueP_id', 'afiSalud', 'grado', 'estudia', 'leerEscribir', 'SNprograma', 'programa', 'user_create_id', 'user_update_id',
    ];
}
