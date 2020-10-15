<?php

namespace App\Http\Controllers;

use App\AtencionPsicosocial;
use App\Personas;
use App\Plan;
use App\HechoVictimizante;
use App\HechoVictima;
use App\Grupo;
use App\Atributo;
use App\Variable;
use Illuminate\Http\Request;

class AtencionPsicosocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Personas $persona)
    {

        $hechosV = HechoVictimizante::orderBy('name', 'ASC')->get();
        $entidad = Grupo::orderBy('titulo', 'ASC')->get()->pluck('titulo', 'id')->toArray();
        return view('psicosocial.create', compact('persona', 'hechosV', 'entidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, array(
      'fechaAtencion' => 'required',
      'tipoIntervencion' => 'required',
      ));

        $hoy = date('Y-m-d');
        $plan = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->first();
        //$atributoAccionPsicosocial = Atributo::where('plan_id',$plan->id)->where('tipo',2)->first();
        $variableAccionPsicosocial = Variable::where('tipo',11)->first();

        $accion = Variable::findOrFail($variableAccionPsicosocial->id);
        $atributo = Atributo::findOrFail($accion->referencia_atributos);

        $fecAtencion = date('Y-m-d', strtotime($request->fechaAtencion));

        // BUsqueda de todos los atributos siguientes que son del tipo tiempo
        foreach($atributo->siguientesTiempos()  as $siguientes)
        {
            $algo = json_decode($siguientes->valor,true);
            $padre = Atributo::findOrFail($siguientes->referencia_id);
            //dd($padre);
            $desde = $algo['d'];
            $desde = date('Y-m-d', strtotime($desde));
            $hasta = $algo['h'];
            $hasta = date('Y-m-d', strtotime($hasta));



              // Busqueda entre fechas registradas en el atributo y la fecha de creaccion del evento
              if ($fecAtencion>=$desde && $fecAtencion<=$hasta ){
                $a = AtencionPsicosocial::create($request->except('hechosV'));
                foreach($request->hechosV as $hechos)
                {
                  $hecho = new HechoVictima();
                  $hecho->persona_id = $persona->id;
                  $hecho->hechoV_id = $hechos;
                  $hecho->save();
                }
                //dd($atencion->id);
                //dd($desde);
                $variableFechas = new Variable;
                $variableFechas->variable = $a->id;
                $variableFechas->referencia_atributos = $siguientes->id;
                $variableFechas->parent_id = $accion->id;
                $variableFechas->save();

                $variablePadreTiempo = new Variable;
                $variablePadreTiempo->referencia_atributos = $padre->id;
                $variablePadreTiempo->variable = $a->id;
                $variablePadreTiempo->parent_id = $accion->id;
                $variablePadreTiempo->save();

                // Busqueda de las variables para presupuesto.
                foreach($siguientes->siguientes() as $presupuesto)
                {
                  if($presupuesto->tipo == '7')
                  {
                    $padrePresupuesto = Atributo::findOrFail($presupuesto->referencia_id);
                    $arreglo = json_decode($presupuesto->valor,true);
                    $a1 = $arreglo['a1'];
                    $a2 = $arreglo['a2'];
                    $a3 = $arreglo['a3'];

                    $sumaMetas = Variable::where('referencia_atributos','=',$a2)->where('parent_id','=',$accion->id)->count();
                    $metaAsignada = Variable::where('referencia_atributos','=',$a1)->where('parent_id','=',$accion->id)->first();
                    $presupuestoAsignado = Variable::where('referencia_atributos','=',$a3)->where('parent_id','=',$accion->id)->first();

                    if($metaAsignada->variable > 0){
                      $resultado = floatval($sumaMetas) * floatval($presupuestoAsignado->variable) / floatval($metaAsignada->variable);
                      $resultadoIndividual = 1 * floatval($presupuestoAsignado->variable) / floatval($metaAsignada->variable);
                    }else{
                      $resultado = 0;
                      $resultadoIndividual = 0;
                    }
                    //dd(floatval($metaAsignada->variable));
                    $varRepetida = Variable::where('referencia_atributos','=',$presupuesto->id)->where('parent_id','=',$accion->id)->first();
                    $varRepetidaPadre = Variable::where('referencia_atributos','=',$padrePresupuesto->id)->where('parent_id','=',$accion->id)->first();

                    if(isset($varRepetida))
                    {
                      $varRepetida->variable = $resultado;
                      $varRepetida->save();

                    }else{

                      $prespuestoVariable = new Variable;
                      $prespuestoVariable->variable = $resultado;
                      $prespuestoVariable->referencia_atributos = $presupuesto->id;
                      $prespuestoVariable->parent_id = $accion->id;
                      $prespuestoVariable->save();

                    }

                    if(isset($varRepetidaPadre))
                    {
                      $varRepetidaPadre->variable = $varRepetidaPadre->variable + $resultadoIndividual;
                      $varRepetidaPadre->save();

                    }else{

                      $prespuestoVariablePadre = new Variable;
                      $prespuestoVariablePadre->variable = $resultado;
                      $prespuestoVariablePadre->referencia_atributos = $padrePresupuesto->id;
                      $prespuestoVariablePadre->parent_id = $accion->id;
                      $prespuestoVariablePadre->save();

                    }


                    return back()->with('info', 'Atención Psicosocial creada Correctamente');

                  }

                }
              }
        }

        return back()->with('infoError', 'La fecha no esta activa para esa acción en especifico.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AtencionPsicosocial  $atencionPsicosocial
     * @return \Illuminate\Http\Response
     */
    public function show(AtencionPsicosocial $atencionPsicosocial)
    {
        $persona = Personas::where('id', $atencionPsicosocial->persona_id)->first();
        return view('psicosocial.show', compact('atencionPsicosocial', 'persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AtencionPsicosocial  $atencionPsicosocial
     * @return \Illuminate\Http\Response
     */
    public function edit(AtencionPsicosocial $atencionPsicosocial)
    {
        $persona = Personas::where('id', $atencionPsicosocial->persona_id)->first();
        $hechosV = HechoVictimizante::orderBy('name', 'ASC')->get();
        $entidad = Grupo::orderBy('titulo', 'ASC')->get()->pluck('titulo', 'id')->toArray();
        return view('psicosocial.edit', compact('atencionPsicosocial', 'hechosV', 'entidad', 'persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AtencionPsicosocial  $atencionPsicosocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtencionPsicosocial $atencionPsicosocial)
    {
        $a = AtencionPsicosocial::find($atencionPsicosocial->id)->update($request->except('hechosV'));
        foreach($request->hechosV as $hechos)
        {
          $hecho = new HechoVictima();
          $hecho->persona_id = $persona->id;
          $hecho->hechoV_id = $hechos;
          $hecho->save();
        }
        session()->flash('mensaje', 'Atencion Psicosocial Actualizada con éxito!');
        return redirect()->route('psicosocial.show', $a->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AtencionPsicosocial  $atencionPsicosocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtencionPsicosocial $atencionPsicosocial)
    {
      $a = AtencionPsicosocial::find($atencionPsicosocial->id)->delete();
      session()->flash('mensaje', 'Atencion Psicosocial Eliminada con éxito!');
      return back();
    }
}
