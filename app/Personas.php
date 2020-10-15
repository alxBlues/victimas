<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Personas extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

  protected $fillable = [
        'id','evento', 'lugar', 'fechaAtencion','primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'fechaNacimiento', 'tipoDoc', 'identificacion',
        'edad', 'grado', 'telefono', 'area', 'estrato', 'salud', 'tipoP_id', 'enfoqueP_id', 'genero_id', 'user_id'
    ];

    protected $auditInclude = [
        'evento', 'lugar', 'fechaAtencion','primerNombre', 'segundoNombre', 'primerApellido', 'segundoApellido', 'fechaNacimiento', 'tipoDoc', 'identificacion',
        'edad', 'grado', 'telefono', 'area', 'estrato', 'salud', 'tipoP_id', 'enfoqueP_id', 'genero_id', 'user_id',
    ];

    public function scopeSearch($query, $data)
    {
      if ($data) {
        return $query->where('identificacion', 'LIKE', "%$data%")->orWhere('primerNombre', 'LIKE', "%$data%")->orWhere('primerApellido', 'LIKE', "%$data%")->orWhere('id', 'LIKE', "%$data%");
      }



    }

    public function documentos()
    {
      return $this->belongsTo(Categoria::class,'tipoDoc','id');
    }

    public function hechosPersona()
    {
    return $this->belongsToMany('App\HechoVictimizante', 'hecho_victimas','persona_id','hechoV_id');
    }

    public function grados()
    {
      return $this->belongsTo(Categoria::class,'grado','id');
    }


}
