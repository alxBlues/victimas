<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Variable;
use App\Atributo;
use App\Categoria;
use App\Grupo;
use Illuminate\Http\Request;
use Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $planes = Plan::get();

        return view('planes.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('planes.create');
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
        //
        $userId = Auth::id();

        $this->validate($request, array(
        'titulo' => 'required',
        'fecha_inicial' => 'required',
        'fecha_final' => 'required',
        ));

        $hoy = date('Y-m-d');
        $planActual = Plan::where('desde','<=',$hoy)->where('hasta','>=',$hoy)->where('referencia_variables',null)->first();


        $desde = date('Y-m-d', strtotime($request->fecha_inicial));
        $hasta = date('Y-m-d', strtotime($request->fecha_final));
        $plan = new Plan;
        if(!empty($planActual)){
          $plan->referencia_variables = $planActual->id;

        }
        $plan->desde = $desde;
        $plan->hasta = $hasta;
        $plan->titulo = $request->titulo;
        $plan->save();

        if(!empty($planActual)){
        return back()->with('info', 'Plan Secundario Creado Correctamente');
      }else{
        return back()->with('info', 'Plan Principal Creado Correctamente');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show($plan)
    {
        //
        $plan = Plan::find($plan);
        $categorias = Categoria::where('tipo', 1)->get()->pluck('titulo', 'id')->toArray();
        $atributos = Atributo::where('plan_id',$plan->id)->get()->pluck('titulo', 'id')->toArray();
        $grupos = Grupo::get()->pluck('titulo', 'id')->toArray();
        return view('planes.show', compact('plan','categorias','atributos','grupos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function matriz($plan)
    {
        //
        $plan = Plan::find($plan);
        $atributo = Atributo::where('plan_id',$plan->id)->where('tipo',2)->first();
        $acciones = Variable::where('referencia_atributos',$atributo->id)->get();
        return view('planes.matriz', compact('plan','acciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
