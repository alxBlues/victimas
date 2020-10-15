<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Comite extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
    protected $fillable = [
        'id', 'accion', 'fecha_comite', 'nombre', 'url_adjunto', 'descripcion', 'user_id',
    ];
    
     protected $auditInclude = [
        'accion', 'fecha_comite', 'nombre', 'url_adjunto', 'descripcion', 'user_id',
    ];
}
