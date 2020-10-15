<?php

namespace App\Http\Controllers;

use App\Atributo;
use App\Comite;
use App\Variable;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
  {
    // $atrubuto = Atributo::where('titulo','Acciones')->first();
    // $acciones = Variable::where('referencia_atributos', $atrubuto->id)->where('tipo', '18')->where('estado', '1')->get()->pluck('variable', 'id')->toarray();
    return view('comite.index');
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
      /*'comite_acciones' => 'required|max:255',*/
      'comite_fecha' => 'required|date',
      'comite_nombre' => 'required|max:255',
      'comite_acta' => 'required|file',
      'comite_descripcion' => 'max:455',
      'user_id' => 'max:255',
    ]);

    if ($fileA = $request->file('comite_acta')) {
      $nameA  = time() . '_' . $fileA->getClientOriginalName();
      $target_pathA    =   '/home/comvictimas/public_html/uploads/';
      $urlA = $target_pathA . $nameA;
      $fileA->move($target_pathA, $nameA);

      $urlForSql = '/uploads/' . $nameA;
      $comite = new Comite();
      /*$comite->accion = $validatedData['comite_acciones'];*/
      $comite->fecha_comite = $validatedData['comite_fecha'];
      $comite->nombre = $validatedData['comite_nombre'];
      $comite->url_adjunto = $urlForSql;
      $comite->descripcion = $validatedData['comite_descripcion'];
      $comite->user_id = $validatedData['user_id'];
      $comite->save();
    }

    // // Ingreso al Plan
    // $accion = Variable::findOrFail($validatedData['comite_acciones']);
    // $atributo = Atributo::findOrFail($accion->referencia_atributos);

    // $fecAtencion = date('Y-m-d', strtotime($validatedData['comite_fecha']));

    // // BUsqueda de todos los atributos siguientes que son del tipo tiempo

    // foreach($atributo->siguientesTiempos()  as $siguientes)
    // {
    //     $algo = json_decode($siguientes->valor,true);
    //     $padre = Atributo::findOrFail($siguientes->referencia_id);
    //     //dd($padre);
    //     $desde = $algo['d'];
    //     $desde = date('Y-m-d', strtotime($desde));
    //     $hasta = $algo['h'];
    //     $hasta = date('Y-m-d', strtotime($hasta));

    //       // Busqueda entre fechas registradas en el atributo y la fecha de creaccion del evento
    //       if ($fecAtencion>=$desde && $fecAtencion<=$hasta ){
    //           $comite->save();
    //         //dd($atencion->id);
    //         //dd($desde);
    //         $variableFechas = new Variable;
    //         $variableFechas->variable = $comite->id;
    //         $variableFechas->referencia_atributos = $siguientes->id;
    //         $variableFechas->parent_id = $accion->id;
    //         $variableFechas->save();

    //         $variablePadreTiempo = new Variable;
    //         $variablePadreTiempo->referencia_atributos = $padre->id;
    //         $variablePadreTiempo->variable = $comite->id;
    //         $variablePadreTiempo->parent_id = $accion->id;
    //         $variablePadreTiempo->save();

    //         // Busqueda de las variables para presupuesto.
    //         foreach($siguientes->siguientes() as $presupuesto)
    //         {
    //           if($presupuesto->tipo == '7')
    //           {
    //             $padrePresupuesto = Atributo::findOrFail($presupuesto->referencia_id);
    //             $arreglo = json_decode($presupuesto->valor,true);
    //             $a1 = $arreglo['a1'];
    //             $a2 = $arreglo['a2'];
    //             $a3 = $arreglo['a3'];

    //             $sumaMetas = Variable::where('referencia_atributos','=',$a2)->where('parent_id','=',$accion->id)->count();
    //             $metaAsignada = Variable::where('referencia_atributos','=',$a1)->where('parent_id','=',$accion->id)->first();
    //             $presupuestoAsignado = Variable::where('referencia_atributos','=',$a3)->where('parent_id','=',$accion->id)->first();

    //             if($metaAsignada->variable > 0){
    //               $resultado = floatval($sumaMetas) * floatval($presupuestoAsignado->variable) / floatval($metaAsignada->variable);
    //               $resultadoIndividual = 1 * floatval($presupuestoAsignado->variable) / floatval($metaAsignada->variable);
    //             }else{
    //               $resultado = 0;
    //               $resultadoIndividual = 0;
    //             }

    //             //dd(floatval($metaAsignada->variable));
    //             $varRepetida = Variable::where('referencia_atributos','=',$presupuesto->id)->where('parent_id','=',$accion->id)->first();
    //             $varRepetidaPadre = Variable::where('referencia_atributos','=',$padrePresupuesto->id)->where('parent_id','=',$accion->id)->first();

    //             if(isset($varRepetida))
    //             {
    //               $varRepetida->variable = $resultado;
    //               $varRepetida->save();

    //             }else{

    //               $prespuestoVariable = new Variable;
    //               $prespuestoVariable->variable = $resultado;
    //               $prespuestoVariable->referencia_atributos = $presupuesto->id;
    //               $prespuestoVariable->parent_id = $accion->id;
    //               $prespuestoVariable->save();

    //             }

    //             if(isset($varRepetidaPadre))
    //             {
    //               $varRepetidaPadre->variable = $varRepetidaPadre->variable + $resultadoIndividual;
    //               $varRepetidaPadre->save();

    //             }else{

    //               $prespuestoVariablePadre = new Variable;
    //               $prespuestoVariablePadre->variable = $resultado;
    //               $prespuestoVariablePadre->referencia_atributos = $padrePresupuesto->id;
    //               $prespuestoVariablePadre->parent_id = $accion->id;
    //               $prespuestoVariablePadre->save();

    //             }


    //             return back()->with('info', 'Acci¨®n del Tipo Comite Creada Correctamente');

    //           }

    //         }
    //       }

    // }

    return back()->with('info', 'Comite Creada Correctamente.');
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
     * Display the specified conten.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchview()
    {
        //$atrubuto = Atributo::where('id','4')->get()->toarray();
        //print_r('hola atrubuto'.$atrubuto);
        //$acciones = Variable::where('referencia_atributos', $atrubuto->id)->where('tipo', '18')->where('estado', '1')->get()->pluck('variable', 'id')->toarray();

        return view('comite.search', compact(/*'acciones',*/ 'atrubuto'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data = $request->comite_busqueda;
        $num_resultado_comite = Comite::where("nombre",'LIKE', "%$data%")->orWhere("fecha_comite",'LIKE', "%$data%")->orWhere("id",'LIKE', "%$data%")->count();
        $resultado_comite = Comite::where("nombre",'LIKE', "%$data%")->orWhere("fecha_comite",'LIKE', "%$data%")->orWhere("id",'LIKE', "%$data%")->get();

        $atrubuto = Atributo::where('titulo','Acciones')->first();
       // $acciones = Variable::where('referencia_atributos', $atrubuto->id)->where('tipo', '18')->where('estado', '1')->get()->pluck('variable', 'id')->toarray();

        if ($num_resultado_comite != 0) {
            return view('comite.search', compact('resultado_comite'/*, 'acciones'*/));
        } else {
            session()->flash('mensajeE', 'Comite NO existente');
            return back();
        }
        // return $request;
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
