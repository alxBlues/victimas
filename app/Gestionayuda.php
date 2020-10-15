<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Gestionayuda extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
    protected $fillable = [
        'id','nombre', 'tipo', 'costo', 'cantidad', 'descripcion', 'estado',
    ];
    
    
    protected $auditInclude = [
        'nombre', 'tipo', 'costo', 'cantidad', 'descripcion', 'estado',
    ];
}
