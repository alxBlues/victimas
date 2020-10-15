<?php

namespace App\Http\Controllers;

use App\Gestionayuda;
use Illuminate\Http\Request;
use Auth;

class GestionayudasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayudas = Gestionayuda::get();

        return view('gestionAyudas.index', compact('ayudas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestionAyudas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'Ayuda_nombre' => 'required|max:255',
           // 'Ayuda_tipo' => 'required|max:255',
            'Ayuda_costo' => 'required|max:255',
            'Ayuda_cantidad' => 'required|max:255',
            'Ayuda_descripcion' => 'max:455',
        ]);

        $ayuda = new Gestionayuda();
        $ayuda->nombre = $validatedData['Ayuda_nombre'];
        //$ayuda->tipo = $validatedData['Ayuda_tipo'];
        $ayuda->costo = $validatedData['Ayuda_costo'];
        $ayuda->cantidad = $validatedData['Ayuda_cantidad'];
        $ayuda->descripcion = $validatedData['Ayuda_descripcion'];
        $ayuda->estado = '1';
        $ayuda->user_id = $userId;
        $ayuda->save();


        return back()->with('info','Creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('gestionAyudas.show');
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
        $validatedData = $request->validate([
            'Ayuda_nombre' => 'required|max:255',
            //'Ayuda_tipo' => 'required|max:255',
            'Ayuda_costo' => 'required|max:255',
            'Ayuda_cantidad' => 'required|max:255',
            'Ayuda_descripcion' => 'max:455',
            'Ayuda_estado' => 'max:255',

        ]);

        $ayudaUp  = Gestionayuda::findOrFail($id);
        $ayudaUp->nombre = $validatedData['Ayuda_nombre'];
        //$ayudaUp->tipo = $validatedData['Ayuda_tipo'];
        $ayudaUp->costo = $validatedData['Ayuda_costo'];
        $ayudaUp->cantidad = $validatedData['Ayuda_cantidad'];
        $ayudaUp->descripcion = $validatedData['Ayuda_descripcion'];
        $ayudaUp->estado = $validatedData['Ayuda_estado'];

        $ayudaUp->save();
        return back()->with('info','Actualizada correctamente');
        // return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gestionayuda)
    {
        $genero = Gestionayuda::find($gestionayuda)->delete();
        session()->flash('mensaje', 'Ayuda eliminada con éxito!');
        return redirect()->route('gestionayudas.index')->with('info','Elimino correctamente');
        // return $gestionayuda;
    }
}
