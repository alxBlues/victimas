<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use DateTime;

class Plan extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;
    //
    protected $fillable = [
        'id', 'titulo','referencia_variables','desde','hasta'
    ];
    protected $auditInclude = [
      'titulo','referencia_variables','desde','hasta',

    ];

    public function atributos()
    {
        return $this->hasMany(Atributo::class,'plan_id','id');
    }

    public function planActivo($fechaInicio, $fechaFinal)
    {
        $hoy = date('Y-m-d');
        $estado = 0;
        if (($hoy >= $fechaInicio) && ($hoy <= $fechaFinal)){
            return ++$estado;
        }else{
            return $estado;
        }
    }

    public function duracion($plan)
    {
      $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $this->desde);
      $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $this->hasta);
      $different_days = $start_date->diffInDays($end_date);
      return $different_days;
    }

    public function cumplimientoMetas($plan)
    {
      $atributo = Atributo::where('tipo',5)->where('plan_id',$this->id)->first();
      $sumaCM = 0;
      $sumaTM = 0;
      if(isset($atributo)){
          $atributoAnterior = $atributo->anterior();
          $sumaCM = Variable::where('referencia_atributos',$atributo->id)->sum('variable');
          $sumaTM = Variable::where('referencia_atributos',$atributoAnterior->id)->sum('variable');
          if($sumaCM == 0){
            return 0;

          }else{
            return $sumaCM * 100 / $sumaTM;
          }
      }else{
        return 0;
      }

    }
}
