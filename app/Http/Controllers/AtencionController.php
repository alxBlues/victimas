<?php

namespace App\Http\Controllers;

use App\Atencion;
use App\Personas;
use App\Variable;
use App\Atributo;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Personas $persona)
    {


      $atenciones = DB::table('atencions')
                      ->join('personas', 'atencions.persona_id', '=', 'personas.id')
                      ->join('variables', 'atencions.accion_id', '=', 'variables.id')
                      ->select('variables.variable', 'atencions.id', 'atencions.fecha', 'atencions.descripcion')
                      ->where('atencions.persona_id', '=', $persona->id)
                      ->where('variables.referencia_atributos','=', '39')
                      ->get();
      return view('atenciones.index', compact('atenciones', 'persona'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Personas $persona)
    {
      $hoy = date('Y-m-d');
      $planes = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->get()->pluck('titulo', 'id')->toArray();

        return view('atenciones.create', compact('persona', 'planes'));
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
        'descripcion' => 'required',
        'lugar' => 'required',
        'fecha' => 'required',
        'accion_id' => 'required',
        ));


        $accion = Variable::findOrFail($request->accion_id);
        $atributo = Atributo::findOrFail($accion->referencia_atributos);

        $fecAtencion = date('Y-m-d', strtotime($request->fecha));
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
              // Busqueda entre fechas registradas en el atributo y la fecha de creaccion de la atencion
              if ($fecAtencion>=$desde && $fecAtencion<=$hasta ){

                $atencion = Atencion::create($request->all());
                //dd($atencion->id);
                //dd($desde);
                $variableFechas = new Variable;
                $variableFechas->variable = $atencion->id;
                $variableFechas->referencia_atributos = $siguientes->id;
                $variableFechas->parent_id = $accion->id;
                $variableFechas->save();

                $variablePadreTiempo = new Variable;
                $variablePadreTiempo->referencia_atributos = $padre->id;
                $variablePadreTiempo->variable = $atencion->id;
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


                    return back()->with('info', 'Atención creada Correctamente');

                  }

                }
              }

        }
        return back()->with('infoError', 'La fecha no esta activa para esa acción en especifico.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function show(Atencion $atencion)
    {
      $atenciones = DB::table('atencions')
                      ->join('personas', 'atencions.persona_id', '=', 'personas.id')
                      ->join('variables', 'atencions.accion_id', '=', 'variables.id')
                      ->select('variables.variable', 'atencions.id', 'atencions.fecha', 'atencions.persona_id', 'atencions.descripcion','atencions.lugar','personas.primerNombre', 'personas.primerApellido')
                      ->where('atencions.id', '=', $atencion->id)
                      ->first();
      return view('atenciones.show', compact('atenciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function edit(Atencion $atencion)
    {
      $variables = Variable::where('referencia_atributos',39)->get()->pluck('variable', 'id')->toArray();
      $atenciones = DB::table('atencions')
                      ->join('personas', 'atencions.persona_id', '=', 'personas.id')
                      ->join('variables', 'atencions.accion_id', '=', 'variables.id')
                      ->select('variables.variable', 'atencions.id', 'atencions.fecha', 'atencions.persona_id', 'atencions.descripcion','atencions.lugar','personas.primerNombre', 'personas.primerApellido')
                      ->where('atencions.id', '=', $atencion->id)
                      ->first();
      return view('atenciones.edit', compact('atenciones', 'variables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atencion $atencion)
    {
      $atencion = Atencion::find($atencion->id)->update($request->all());
      session()->flash('mensaje', 'Atencion actualizada con éxito!');
      return redirect()->route('atencion.index', $atencion->persona_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atencion $atencion)
    {
      $atencion = Atencion::find($atencion->id)->delete();
      session()->flash('mensaje', 'Atencion eliminada con éxito!');
      return redirect()->route('atencion.index', $atencion->persona_id);
    }
}
