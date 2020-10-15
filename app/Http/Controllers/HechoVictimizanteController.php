<?php

namespace App\Http\Controllers;

use App\HechoVictimizante;
use App\HechoVictima;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\CrearHechoVictimizante;
class HechoVictimizanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hechos = HechoVictimizante::get();
        return view('hechosVictimizantes.index', compact('hechos'));
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
    public function store(CrearHechoVictimizante $request)
    {
        $hecho = HechoVictimizante::create($request->all());
        session()->flash('mensaje', 'Hecho Victimizante registrado con éxito!');
        return redirect()->route('hechos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HechoVictimizante  $hechoVictimizante
     * @return \Illuminate\Http\Response
     */
    public function show(HechoVictimizante $hechoVictimizante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HechoVictimizante  $hechoVictimizante
     * @return \Illuminate\Http\Response
     */
    public function edit(HechoVictimizante $hechoVictimizante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HechoVictimizante  $hechoVictimizante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HechoVictimizante $hechoVictimizante)
    {
        $hecho = HechoVictimizante::find($hechoVictimizante->id)->update($request->all());
        session()->flash('mensaje', 'Hecho Victimizante actualizado con éxito!');
        return redirect()->route('hechos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HechoVictimizante  $hechoVictimizante
     * @return \Illuminate\Http\Response
     */
    public function destroy(HechoVictimizante $hechoVictimizante)
    {
        $hecho = HechoVictimizante::find($hechoVictimizante->id)->delete();
        session()->flash('mensaje', 'Hecho Victimizante eliminado con éxito!');
        return redirect()->route('hechos.index');
    }

}
