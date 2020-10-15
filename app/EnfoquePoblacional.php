<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EnfoquePoblacional extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
  protected $fillable = [
        'id', 'name',
    ];
    
    
    protected $auditInclude = [
        'name',
    ];
}
