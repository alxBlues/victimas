<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HechoVictimizante extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

  protected $fillable = [
        'id','name',
    ];

    protected $auditInclude = [
        'name',
    ];

    public function hechosPersona()
    {
    return $this->belongsToMany('App\Personas', 'hecho_victimas','hechoV_id','persona_id');
    }

    public function siPersona($persona)
    {
      return HechoVictima::where('hechoV_id',$this->id)->where('persona_id',$persona)->first();
    }
}
