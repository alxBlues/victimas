<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HechoVictima extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
  protected $fillable = [
        'id', 'hechoV_id', 'persona_id',
    ];
    
    protected $auditInclude = [
        'hechoV_id', 'persona_id',
    ];
}
