<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Grupo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
    //
    use NodeTrait;

    protected $fillable = ['titulo'];
    
    protected $auditInclude = [
        'titulo',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
