<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Variable extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use NodeTrait;

    protected $auditThreshold = 10;



  protected $fillable = [
        'id','variable','referencia_atributos','tipo','estado','parent_id','_lft','_rgt'
    ];

    protected $auditInclude = [
        'variable','referencia_atributos','tipo','estado','parent_id','_lft','_rgt',
    ];
    //
    public function atributos()
        {
          return $this->belongsTo(Atributo::class,'referencia_atributos','id');
        }


        public function children()
        {
            return $this->hasMany(Variable::class,'parent_id')->with('children');
        }
        public function padre()
        {
            return $this->belongsTo(Variable::class,'parent_id','id');
        }
        public function antepasado()
        {
          return $this->ancestors()->whereIsRoot()->first();
        }

        public function grupo()
        {
          return $this->belongsTo(Grupo::class,'variable','id');
        }

        public function atenciones()
        {
          return $this->belongsTo(Atencion::class,'id','accion_id');
        }

        public function atencion()
        {
          return $this->belongsTo(Atencion::class,'variable','id');
        }

        public function registros()
        {
          return Variable::where('referencia_atributos',$this->referencia_atributos)->where('parent_id', $this->parent_id)->count();
        }

        public function valorBusqueda($padre, $atributo)
        {
            return variable::where('referencia_atributos',$atributo)->where('parent_id', $padre)->first();
        }
        public function porcentajeCumplimiento($general, $parcial)
        {
          return floatval($parcial) * 100 / floatval($general);
        }
        public function ayudas()
        {
          return $this->belongsTo(Categoria::class,'tipo','id');
        }

        public function atencionAyudas()
        {
          return $this->belongsTo(Ayudavictima::class,'variable','id');
        }
        
        public function psicosocial()
        {
          return $this->belongsTo(AtencionPsicosocial::class,'variable','id');
        }
        
        public function juridica()
        {
          return $this->belongsTo(atencion_juridica::class,'variable','id');
        }

        public function comites()
        {
          return $this->belongsTo(Comite::class,'variable','id');
        }



}
