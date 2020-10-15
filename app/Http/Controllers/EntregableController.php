<?php

namespace App\Http\Controllers;

use App\Entregable;
use App\Plan;
use App\Atributo;
use App\Variable;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Crypt;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;


class EntregableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $userId = Auth::id();
      //dd($request->all());
        $rol = auth()->user()->roles->first();

        if($request->desde==null){$desde="0000-01-01 00:00:00";}else{$desde=$request->desde;}
        if($request->hasta==null){$hasta="4000-01-01 00:00:00";}else{$hasta=$request->hasta;}
        $desde = date('Y-m-d h:i:s', strtotime($desde));
        $hasta = date('Y-m-d h:i:s', strtotime($hasta));

        $entregables = new Entregable();
        if($rol->id!='1' and $rol->id!='4')
        $entregables = $entregables->where('entregables.user_id', '=', $userId);
        $entregables = $entregables->join('users','users.id','=','entregables.user_id')
        ->join('variables', 'variables.id','=','entregables.accion')
        ->where(DB::raw('CONCAT_WS(" ", entregables.observacion, users.name, users.email, entregables.id, variables.variable)'), 'like', '%' . $request->get('palabra') . '%')
        ->whereBetween('entregables.created_at', [$desde, $hasta])
        ->where('variables.estado',1)
        ->orderBy('entregables.created_at', 'desc')
        ->select('entregables.*')
        ->paginate(10);

        $hoy = date('Y-m-d');
        $planes = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->get()->pluck('titulo', 'id')->toArray();

        return view('entregables.index', compact('entregables','planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $hoy = date('Y-m-d');
        $planes = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->get()->pluck('titulo', 'id')->toArray();

        return view('entregables.create', compact('planes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'accion_id' => 'required',
            'comentario' => 'required',
            'archivo' => 'required|file',

        ]);
        $userId = Auth::id();
        $entregable = new Entregable;
        $entregable->accion = $request->accion_id;
        $entregable->observacion = $request->comentario;

        $uploadedFile = $request->file('archivo');
        $filename = time().$uploadedFile->getClientOriginalName();

        //dd($filename);
      Storage::disk('local')->putFileAs(
        'files/'.$filename,
        $uploadedFile,
        $filename
      );



        $entregable->user_id = $userId;
        $entregable->archivo = $filename;



        $accion = Variable::findOrFail($request->accion_id);
        $atributo = Atributo::findOrFail($accion->referencia_atributos);

        $fechaEntrega = date('Y-m-d');

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
              if ($fechaEntrega>=$desde && $fechaEntrega<=$hasta ){
                  $entregable->save();
                //dd($atencion->id);
                //dd($desde);
                $variableFechas = new Variable;
                $variableFechas->variable = $entregable->id;
                $variableFechas->referencia_atributos = $siguientes->id;
                $variableFechas->parent_id = $accion->id;
                $variableFechas->save();

                $variablePadreTiempo = new Variable;
                $variablePadreTiempo->referencia_atributos = $padre->id;
                $variablePadreTiempo->variable = $entregable->id;
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


                    return back()->with('info', 'Acción Entregable Creada Correctamente');

                  }

                }
              }

        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function show(Entregable $entregable)
    {
        //
        return view('entregables.show',compact('entregable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function edit(Entregable $entregable)
    {
        //
        $hoy = date('Y-m-d');
        $planes = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->get()->pluck('titulo', 'id')->toArray();

        return view('entregables.edit',compact('entregable','planes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entregable $entregable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entregable  $entregable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entregable $entregable)
    {
        //
        $entregable->delete();

        return back()->with('info','Accion Entregable eliminada con exito');
    }
}
