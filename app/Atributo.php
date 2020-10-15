<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Atributo extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

    protected $fillable = [
          'id','titulo', 'nivel', 'tipo', 'valor', 'referencia_id','plan_id'
      ];

      protected $auditInclude = [
        'titulo', 'nivel', 'tipo', 'valor', 'referencia_id','plan_id',

      ];
      
    public function variables()
        {
          return $this->hasMany(Variable::class,'referencia_atributos','id');
        }

        public function siguiente(){

            return Atributo::where('plan_id',$this->plan_id)->where('id', '>', $this->id)->orderBy('id','asc')->first();

        }
        public  function anterior(){

            return Atributo::where('plan_id',$this->plan_id)->where('id', '<', $this->id)->orderBy('id','desc')->first();

        }
        public function siguientes(){

            return Atributo::where('plan_id',$this->plan_id)->where('id', '>', $this->id)->orderBy('id','asc')->get();

        }
        public function anteriores(){

            return Atributo::where('plan_id',$this->plan_id)->where('id', '<', $this->id)->orderBy('id','asc')->get();

        }
        public function siguientesTiempos(){

            return Atributo::where('plan_id',$this->plan_id)->where('id', '>', $this->id)->where('tipo', '=', '9')->orderBy('id','asc')->get();

        }
        public function planes()
            {
              return $this->belongsTo(Plan::class,'plan_id','id');
            }

            public function categorias()
                {
                  return $this->belongsTo(Categoria::class,'tipo','id');
                }
                public function tiempoDesde(){
                  $valorAtributo = Atributo::where('id', $this->id)->first();
                  $algo = json_decode($valorAtributo->valor,true);
                  $desde = $algo['d'];
                  $desde = date('Y-m-d', strtotime($desde));

                  return $desde;
                }
                public function tiempoHasta(){
                  $valorAtributo = Atributo::where('id', $this->id)->first();
                  $algo = json_decode($valorAtributo->valor,true);
                  $hasta = $algo['h'];
                  $hasta = date('Y-m-d', strtotime($hasta));

                  return $hasta;

                }

                public function padreAtributo()
                {
                  return Atributo::where('id',$this->referencia_id)->first();
                }
}
