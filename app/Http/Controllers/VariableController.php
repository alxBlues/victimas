<?php

namespace App\Http\Controllers;

use App\Variable;
use App\Atributo;
use App\Grupo;
use App\Categoria;
use Illuminate\Http\Request;
use Auth;

class VariableController extends Controller
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
        return view('variable.create');
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
        $this->validate($request, array(
        'variable' => 'required',
        ));

        //dd($request->all());
        $plan = $request->plan;
        $padre = $request->padre;
        $userId = Auth::id();

        $variable = new Variable;


        if($request->tipo == 2)
        {
          $padre = $request->variable;
          $actualActributo = $request->atributo;
          $atributo = Atributo::where('id', $actualActributo)->first();
          $plan = $atributo->plan_id;
          $siguienteAtributo = Atributo::where('plan_id',$plan)->where('id', '>', $actualActributo)->orderBy('id','asc')->first();
          $siguienteIdAtributo = $siguienteAtributo->id;
          $variable->variable = $request->$siguienteIdAtributo;
          $variable->referencia_atributos = $siguienteAtributo->id;
          $variable->tipo = $request->tipoAyuda;
          $variable->parent_id = $padre;
          $variable->save();
          $variablePadre = $variable->id;

          $message = array();
          foreach($siguienteAtributo->siguientes()  as $siguientes)
            {
              if($siguientes->tipo == '4' or $siguientes->tipo == '3' or $siguientes->tipo == '10' or $siguientes->tipo == '8')
              {
              $variablex = new Variable;
              $siguienteIdAtributoF = $siguientes->id;
              $variablex->variable = $request->$siguienteIdAtributoF;
              $variablex->referencia_atributos = $siguientes->id;
              $variablex->parent_id = $variablePadre;
              $variablex->save();
              }
            }



        }else{
          $this->validate($request, array(
          'variable' => 'required',
          ));
          if(!empty($request->atributo))
            {
              $actualActributo = $request->atributo;
              $atributo = Atributo::where('id', $actualActributo)->first();
              $plan = $atributo->plan_id;
              $siguienteAtributo = Atributo::where('plan_id',$plan)->where('id', '>', $actualActributo)->orderBy('id','asc')->first();


            }
            else {

              $siguienteAtributo = Atributo::where('plan_id',$plan)->orderBy('id','asc')->first();

            }

          $variable->referencia_atributos = $siguienteAtributo->id;
          $variable->variable = $request->variable;
          $variable->parent_id = $padre;
          $variable->save();

        }



        return back()->with('info', 'Variable Creada Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function show(Variable $variable)
    {
        //
        $atributos = Atributo::get();
        $grupos = Grupo::get()->pluck('titulo', 'id')->toArray();
        $ayudas = Categoria::where('tipo',2)->pluck('titulo', 'id')->toArray();



        return view('variables.show', compact('variable','atributos','grupos','ayudas'));

    }

    /**
     * Pasa el estado a inactivo de la Acción.
     *
     * @param  \App\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function estado(Variable $variable)
    {

      if($variable->estado == 1)
      {
        $variable->estado = 0;
        $variable->save();

        return back()->with('infoError', 'Accion Especifica Inactiva');
      }else{
        $variable->estado = 1;
        $variable->save();

        return back()->with('info', 'Accion Especifica Activa');
      }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function edit(Variable $variable)
    {
        //
        $grupos = Grupo::get()->pluck('titulo', 'id')->toArray();
        $acciones = Categoria::where('tipo',2)->get()->pluck('titulo', 'id')->toArray();


        return view('variables.edit',compact('variable','grupos','acciones'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variable $variable)
    {

        if($request->tipo == 2)
        {
          $request->validate([
          'variable' => 'required',

          ]);
          $identificador = $variable->id;
          $variable  = Variable::findOrFail($identificador);
          $variable->variable = $request->$identificador;
          if($request->tipo_accion>0)
          $variable->tipo = $request->tipo_accion;

        }else{
                  $request->validate([
                  'variable' => 'required',

                  ]);

          $variable  = Variable::findOrFail($variable->id);
          $variable->variable = $request->variable;

        }

        $variable->save();
        return back()->with('info','Actualizada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variable $variable)
    {
        //
        if($variable->atributos->tipo == 2){

            $variable->children()->delete();
            $variable->delete();
            return back()->with('info', 'Eliminado correctamente');


        }
        else{
          if($variable->descendants()->count()>0)
          {

            return back()->with('infoError', 'Primero debe eliminar los descendientes de las variables');
          }

          else{
            $variable->delete();
            return back()->with('info', 'Eliminado correctamente');
          }

        }




    }

    public function verAccion(Variable $variable)
    {
        //
        $atributos = Atributo::get();
        $grupos = Grupo::get()->pluck('titulo', 'id')->toArray();
        $ayudas = Categoria::where('tipo',2)->pluck('titulo', 'id')->toArray();


        return view('variables.accion', compact('variable','atributos','grupos','ayudas'));

    }

    public function getEntregables($id,$tipo)
    {
      if(auth()->user()->hasRole('admin')){
        $grupo = 0;
      }else{
        if(auth()->user()->grupos[0]->exists()){
          $grupo = auth()->user()->grupos[0]->id;
        }else{
          $grupo = 0;
        }
      }


      $atributo = Atributo::where('plan_id',$id)->where('tipo',2)->first();
      $aPermisos = Atributo::where('plan_id',$id)->where('tipo',3)->first();
      $permisos = Variable::where('referencia_atributos',$aPermisos->id)->where('variable',$grupo)->pluck('parent_id')->toArray();
      $hoy = date('Y-m-d');
      $entregables = Variable::where('referencia_atributos',$atributo->id)->where('tipo',$tipo)->where('estado',1)->get();

      if(auth()->user()->grupos()->exists()){
          $entregables = $entregables->only($permisos)->pluck('variable','id')->toArray();

        }else{
          $entregables = Variable::where('referencia_atributos',$atributo->id)->where('tipo',$tipo)->get()->pluck('variable','id')->toArray();

        }

     return json_encode($entregables);
    }

}
