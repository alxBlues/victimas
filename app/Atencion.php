<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Atencion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

  protected $fillable = [
        'id','persona_id', 'accion_id', 'descripcion', 'lugar', 'fecha'
    ];

    protected $auditInclude = [
        'persona_id', 'accion_id', 'descripcion', 'lugar', 'fecha',
    ];
}
