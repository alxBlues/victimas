<?php

namespace App\Http\Controllers;

use App\atencion_juridica;
use Illuminate\Http\Request;
use App\Plan;
use App\Atributo;
use App\Variable;

class AtencionJuridicaController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'max:255',
            'persona_id' => 'max:255',
            'Atencion_juridica_lista_chequeo' => 'required|max:255',
            'Atencion_juridica_otro' => 'max:255',
            'Atencion_juridica_decripcion' => 'max:355',
        ]);

        
        $hoy = date('Y-m-d');
        $plan = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->first();
        //$atributoAccionPsicosocial = Atributo::where('plan_id',$plan->id)->where('tipo',2)->first();
        $variableAccionPsicosocial = Variable::where('tipo',35)->first();

        $accion = Variable::findOrFail($variableAccionPsicosocial->id);
        $atributo = Atributo::findOrFail($accion->referencia_atributos);

        $fecAtencion = date('Y-m-d');

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
                $j= atencion_juridica::create(
                    [
                        'user_id' => $validatedData['user_id'],
                        'persona_id' => $validatedData['persona_id'],
                        'chequeo' => $validatedData['Atencion_juridica_lista_chequeo'],
                        'otros_texto' => $validatedData['Atencion_juridica_otro'],
                        'observaciones' => $validatedData['Atencion_juridica_decripcion']
                    ]
                );
                //dd($atencion->id);
                //dd($desde);
                $variableFechas = new Variable;
                $variableFechas->variable = $j->id;
                $variableFechas->referencia_atributos = $siguientes->id;
                $variableFechas->parent_id = $accion->id;
                $variableFechas->save();

                $variablePadreTiempo = new Variable;
                $variablePadreTiempo->referencia_atributos = $padre->id;
                $variablePadreTiempo->variable = $j->id;
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


                    return  back()->with('info', 'Atencion Juridica efectuada con exito.');

                  }

                }
              }
        }

        return back()->with('infoError', 'La fecha no esta activa para esa acci¨®n en especifico.');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
