<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Entregable extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

    protected $fillable = [
          'id','accion', 'observacion', 'archivo', 'user_id'
      ];

      protected $auditInclude = [
        'accion', 'observacion', 'archivo', 'user_id',

      ];

    public function variables()
    {
      return $this->belongsTo(Variable::class,'accion','id');
    }
    public function user()
    {
    return $this->belongsTo(User::class,'user_id','id');
    }
}
