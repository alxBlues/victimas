<?php

namespace App\Http\Controllers;

use App\Beneficiario;
use App\Personas;
use App\EnfoquePoblacional;
use App\Genero;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
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
        $a = Beneficiario::create($request->all());
        session()->flash('mensaje', 'Beneficiario registrado con éxito!');
        return redirect()->route('personas.show', $a->persona_id)->with('info', 'Beneficiaro registrado corectamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function show(Beneficiario $beneficiario)
    {

        return view('beneficiarios.show', compact('beneficiario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiario $beneficiario)
    {
      $enfoqueP = EnfoquePoblacional::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
      $genero = Genero::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
      return view('beneficiarios.edit', compact('beneficiario', 'enfoqueP', 'genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiario $beneficiario)
    {
        $a = Beneficiario::find($beneficiario->id)->update($request->all());
        session()->flash('mensaje', 'Beneficiario actualizado con éxito!');
        return redirect()->route('beneficiarios.show', $a->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiario $beneficiario)
    {
        $a = Beneficiario::find($beneficiario->id)->delete();
        session()->flash('mensaje', 'Beneficiario eliminado con éxito!');
        return redirect()->route('personas.show', $beneficiario->persona_id);
    }
}
