<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Categoria extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

    //
    protected $fillable = [
       'titulo', 'tipo','id',
   ];

   protected $auditInclude = [
        'titulo', 'tipo',
    ];
}
