<?php

namespace App\Http\Controllers;

use App\Atributo;
use App\Categoria;
use App\Variable;
use Illuminate\Http\Request;
use Auth;

class AtributoController extends Controller
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
        //

        $userId = Auth::id();

        $this->validate($request, array(
        'titulo' => 'required',
        ));
        $atributo = new Atributo;
        $atributo->titulo = $request->titulo;
        $atributo->plan_id = $request->plan;
        $atributo->tipo = $request->categorias;
        $atributoMeta = Atributo::where('plan_id',$request->plan)->where('tipo',5)->first();
        $atributoPresupuesto = Atributo::where('plan_id',$request->plan)->where('tipo',7)->first();
        if($request->categorias==9)
          {
            $tiempo = ["d"=>$request->desde,"h"=>$request->hasta];
            if(isset($atributoMeta)){
              $atributo->referencia_id = $atributoMeta->id;
            }
            $atributo->valor = json_encode($tiempo);
          }
          if($request->categorias==6)
            {
              $sumaa = ['a1' =>$request->atributouno,'ope' =>'1','a2' =>$request->atributodos];
              $atributo->valor = json_encode($sumaa);
            }

            if($request->categorias==7)
              {
                $porcentajea = ['a1' =>$request->atributouno,'a2' =>$request->atributodos,'a3' =>$request->atributotres];
                $atributo->valor = json_encode($porcentajea);
                if(isset($atributoPresupuesto)){
                  $atributo->referencia_id = $atributoPresupuesto->id;

                }
              }

              if($request->categorias==10)
                {

                  $atributo->valor = $request->tags;
                }


        $atributo->save();

        return back()->with('info', 'Atributo Creado Correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function show(Atributo $atributo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function edit(Atributo $atributo)
    {
        //

        return view('atributos.edit',compact('atributo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atributo $atributo)
    {
        //
        $request->validate([
        'titulo' => 'required',

        ]);

        //dd($atributo->id);
        $atributo  = Atributo::findOrFail($atributo->id);
        $atributo->titulo = $request->titulo;
        $atributo->save();

        return back()->with('infoCrear','Correcto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atributo $atributo)
    {
        //
        if($atributo->variables()->count()>0)
        {

          return back()->with('infoError', 'No se pueden eliminar atributos con variables definidas');

        }else{

          $atributo->delete();

          return back()->with('info', 'Eliminado correctamente');

        }


    }
}
