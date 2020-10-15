<?php

namespace App\Http\Controllers;

use App\EnfoquePoblacional;
use Illuminate\Http\Request;
use App\Http\Requests\CrearEnfoque;

class EnfoquePoblacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enfoques = EnfoquePoblacional::all();
        return view('enfoqueP.index', compact('enfoques'));
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
    public function store(CrearEnfoque $request)
    {
        $enfoque = EnfoquePoblacional::create($request->all());
        session()->flash('mensaje', 'Enfoque Poblacional registrado con éxito!');
        return redirect()->route('enfoqueP.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EnfoquePoblacional  $enfoque
     * @return \Illuminate\Http\Response
     */
    public function show(EnfoquePoblacional $enfoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EnfoquePoblacional  $enfoque
     * @return \Illuminate\Http\Response
     */
    public function edit(EnfoquePoblacional $enfoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EnfoquePoblacional  $enfoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnfoquePoblacional $enfoque)
    {
      $enfoque = EnfoquePoblacional::find($enfoque->id)->update($request->all());
      session()->flash('mensaje', 'Enfoque Poblacional actualizado con éxito!');
      return redirect()->route('enfoqueP.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EnfoquePoblacional  $enfoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnfoquePoblacional $enfoque)
    {
      $enfoque = EnfoquePoblacional::find($enfoque->id)->delete();
      session()->flash('mensaje', 'Enfoque Poblacional eliminado con éxito!');
      return redirect()->route('enfoqueP.index');
    }
}
