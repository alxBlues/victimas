<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'max:255',
            'persona_id' => 'max:255',
            'bitacora_fecha' => 'required|max:255',
            'bitacora_titulo' => 'required|max:255',
            'bitacora_descripcion' => 'max:355',
            'bitacora_estado' => 'required|max:355',
        ]);

        Bitacora::create([
            'user_id' => $validatedData['user_id'],
            'persona_id' => $validatedData['persona_id'],
            'fecha' => $validatedData['bitacora_fecha'],
            'titulo' => $validatedData['bitacora_titulo'],
            'descripcion' => $validatedData['bitacora_descripcion'],
            'estado' => $validatedData['bitacora_estado']
        ]);
        return back()->with('info', 'Bitacora registrada con exito.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bitacora_fecha' => 'required|max:255',
            'bitacora_titulo' => 'required|max:255',
            'bitacora_descripcion' => 'max:355',
            'bitacora_estado' => 'required',
        ]);

        $bitacora = Bitacora::find($id);
        $bitacora->fecha = $validatedData['bitacora_fecha'];
        $bitacora->titulo = $validatedData['bitacora_titulo'];
        $bitacora->descripcion = $validatedData['bitacora_descripcion'];
        $bitacora->estado = $validatedData['bitacora_estado'];
        $bitacora->save();
        return back()->with('info', 'Bitacora actualizada con exito.');
    }
}
