<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bitacora extends Model
{
    protected $fillable = [
        'id','user_id', 'persona_id', 'fecha', 'titulo', 'descripcion', 'estado',
    ];
    
    protected $auditInclude = [
        'user_id', 'persona_id', 'fecha', 'titulo', 'descripcion', 'estado',
    ];
}
