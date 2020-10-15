<?php

namespace App\Http\Controllers;

use App\Ayudavictima;
use App\Plan;
use App\Atributo;
use App\Variable;
use Illuminate\Http\Request;

class AyudaVictimasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $ayudas = Ayudavictima::where('id', $id)->get()->toarray();
        return $ayudas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ayudavictimas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lista = json_decode('[' . str_replace('}{', "},{", $request->Ayudas_ids) . ']');

        $ids_ayudas = [];
        $ayudas = [];
        $suma = [];
            // return $request;
        foreach ($lista as $val) {
            $ids_ayudas[] = $val->id;
            $ayudas[] = $val->name;
            $canti_ayudas[] = $val->repite;
            $suma[] = ($val->valor * $val->repite);
        }

        $ids_ayudas = implode(",", $ids_ayudas);
        $canti_ayudas = implode(",", $canti_ayudas);
        $ayudas = implode(", ", $ayudas);
        $suma = array_sum($suma);

        if ($fileA = $request->file('documentoA')) {
            $nameA  = time() . '_' . $fileA->getClientOriginalName();
            $target_pathA    =   '/home/comvictimas/public_html/uploads/';
            $urlA = $target_pathA . $nameA;
            $fileA->move($target_pathA, $nameA);

            $urlForSql = '/uploads/' . $nameA;
        } else {
            $pathA = '';
        }
        if ($request->file('documentoB')) {
            $request->file('documentoB')->store('/home/comvictimas/public_html/uploads');
            $nameB  = time() . '_' . $request->file('documentoB')->getClientOriginalName();
            $pathB = '/uploads/' . $nameB;
        } else {
            $pathB = '';
        }



        // if ($fileA = $request->file('documentoA')) {
        //     $nameA  = time() . '_' . $fileA->getClientOriginalName();
        //     $target_pathA    =   public_path('/uploads/');
        //     $urlA = $target_pathA . $nameA;
        //     $fileA->move($target_pathA, $nameA);
        // }

        // if ($fileB = $request->file('documentoB')) {
        //     $nameB  = time() . '_' . $fileB->getClientOriginalName();
        //     $target_pathB    =   public_path('/uploads/');
        //     $urlB = $target_pathB . $nameB;
        //     $fileB->move($target_pathB, $nameB);
        // }

        $validatedData = $request->validate([
            'acciones' => 'required',
            'Ayuda_tipo' => 'required|max:255',
            'Ayudas_ids' => 'required|max:255',
            'decripcion' => 'max:455',
            'user_create_id' => 'max:255',
            'persona_id' => 'max:255',
        ]);

        $ayuda = new Ayudavictima();
        $ayuda->accion = $validatedData['acciones'];
        $ayuda->tipo = $validatedData['Ayuda_tipo'];
        $ayuda->ayudas = $ayudas;
        $ayuda->cantidad_ayudas = $canti_ayudas;
        $ayuda->ids_ayudas = $ids_ayudas;
        $ayuda->valor_ayudas = $suma;
        $ayuda->url_adjunto1 = $urlForSql;
        //$ayuda->url_adjunto2 = $pathB;
        $ayuda->descripcion = $validatedData['decripcion'];
        $ayuda->persona_id = $validatedData['persona_id'];
        $ayuda->user_id = $validatedData['user_create_id'];

        $accion = Variable::findOrFail($validatedData['acciones']);
        $atributo = Atributo::findOrFail($accion->referencia_atributos);

        $fecAyuda = date('Y-m-d');


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
              if ($fecAyuda<=$hasta && $fecAyuda>=$desde ){
                //dd($ayuda->id);
                //dd($desde);
                $ayuda->save();

                $variableFechas = new Variable;
                $variableFechas->variable = $ayuda->id;
                $variableFechas->referencia_atributos = $siguientes->id;
                $variableFechas->parent_id = $accion->id;
                $variableFechas->save();

                $variablePadreTiempo = new Variable;
                $variablePadreTiempo->referencia_atributos = $padre->id;
                $variablePadreTiempo->variable = $ayuda->id;
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

                    $resultado = $suma;
                    $resultadoIndividual = $suma;
                    //dd(floatval($metaAsignada->variable));
                    $varRepetida = Variable::where('referencia_atributos','=',$presupuesto->id)->where('parent_id','=',$accion->id)->first();
                    $varRepetidaPadre = Variable::where('referencia_atributos','=',$padrePresupuesto->id)->where('parent_id','=',$accion->id)->first();

                    if(isset($varRepetida))
                    {
                      $varRepetida->variable = $varRepetida->variable + $resultado;
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


                    return back()->with('info', 'Ayuda a la Victima Creada Correctamente');

                  }

                }
              }


        }
        // Fin de registro en el plan
    return back()->with('infoError', 'La fecha no esta activa para esa acción en especifico.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ayudas = Ayudavictima::where('id', $id)->get()->toarray();

        return $ayudas;
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
