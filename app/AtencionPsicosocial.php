<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AtencionPsicosocial extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $auditThreshold = 10;
    
  protected $fillable = [
        'id','fechaAtencion','entidad','tipoIntervencion', 'persona_id', 'departamento', 'municipio', 'barrio', 'direccion', 'tiempoResidencia', 'telefono', 'nombreContacto', 'telContacto', 'departamentoD', 'municipioD', 'barrioD', 'tiempoResidenciaD', 'fechaDesplazamiento', 'fechaDeclaracion', 'fechaInclusion',
        'hechoVictimizante', 'tipoVivienda', 'tipoFamilia', 'duelos', 'violenciaI', 'conflictoPareja', 'violenciaG', 'maltratoI', 'violenciaS', 'transtornoP',
        'dificultadesA', 'otro', 'cual', 'ninguno', 'user_create_id', 'user_update_id', 
    ];
    
    protected $auditInclude = [
        'id','fechaAtencion','entidad','tipoIntervencion', 'persona_id', 'departamento', 'municipio', 'barrio', 'direccion', 'tiempoResidencia', 'telefono', 'nombreContacto', 'telContacto', 'departamentoD', 'municipioD', 'barrioD', 'tiempoResidenciaD', 'fechaDesplazamiento', 'fechaDeclaracion', 'fechaInclusion',
        'hechoVictimizante', 'tipoVivienda', 'tipoFamilia', 'duelos', 'violenciaI', 'conflictoPareja', 'violenciaG', 'maltratoI', 'violenciaS', 'transtornoP',
        'dificultadesA', 'otro', 'cual', 'ninguno', 'user_create_id', 'user_update_id',
    ];
}
