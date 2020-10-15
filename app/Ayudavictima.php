<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Ayudavictima extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

    protected $fillable = [
        'id', 'persona_id', 'accion', 'tipo', 'ayudas', 'cantidad_ayudas', 'ids_ayudas', 'valor_ayudas', 'url_adjunto1', 'url_adjunto2', 'descripcion', 'user_id','created_at'
    ];

    protected $auditInclude = [
        'persona_id', 'accion', 'tipo', 'ayudas', 'cantidad_ayudas', 'ids_ayudas', 'valor_ayudas', 'url_adjunto1', 'url_adjunto2', 'descripcion', 'user_id',
    ];

}
