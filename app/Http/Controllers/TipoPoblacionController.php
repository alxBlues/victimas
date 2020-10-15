<?php

namespace App\Http\Controllers;

use App\TipoPoblacion;
use Illuminate\Http\Request;
use App\Http\Requests\CrearTipoP;
class TipoPoblacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoPoblacion::all();
        return view('tipoPoblacion.index', compact('tipos'));
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
    public function store(CrearTipoP $request)
    {
        $tipo = TipoPoblacion::create($request->all());
        session()->flash('mensaje', 'Tipo de Población registrado con éxito!');
        return redirect()->route('tipoP.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoPoblacion  $tipoPoblacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPoblacion $tipoPoblacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPoblacion  $tipoPoblacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPoblacion $tipoPoblacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPoblacion  $tipoPoblacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPoblacion $tipoPoblacion)
    {
        $tipo = TipoPoblacion::find($tipoPoblacion->id)->update($request->all());
        session()->flash('mensaje', 'Tipo de Población actualizado con éxito!');
        return redirect()->route('tipoP.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPoblacion  $tipoPoblacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPoblacion $tipoPoblacion)
    {
      $tipo = TipoPoblacion::find($tipoPoblacion->id)->delete();
      session()->flash('mensaje', 'Tipo de Población eliminado con éxito!');
      return redirect()->route('tipoP.index');
    }
}
