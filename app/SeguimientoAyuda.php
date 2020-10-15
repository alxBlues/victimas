<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SeguimientoAyuda extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
    protected $fillable = [
        'id', 'fecha_seguimiento', 'motivo_desarrollo_de_la_intervencion', 'acuerdos_observaciones', 'url_adjunto', 'persona_id', 'user_id',
    ];
    
    protected $auditInclude = [
        'fecha_seguimiento', 'motivo_desarrollo_de_la_intervencion', 'acuerdos_observaciones', 'url_adjunto', 'persona_id', 'user_id',
    ];
}