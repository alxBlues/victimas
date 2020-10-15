<?php

namespace App\Http\Controllers;

use App\SeguimientoAyuda;
use Illuminate\Http\Request;

class SeguimientoAyudasController extends Controller
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
        $validatedData = $request->validate([
            'seguimiento_fecha' => 'required|max:255',
            'seguimiento_moivo' => 'required|max:255',
            'seguimiento_acuerdos_observaciones' => 'required|max:255',
            'documento' => 'file',
            'user_id' => 'max:255',
            'persona_id' => 'max:255',
        ]);

        if ($file = $request->file('documento')) {
            $name  = 'seguimiento' . time() . '_' . $file->getClientOriginalName();
            $target_path    =   '/home/comvictimas/public_html/uploads/';
            // $urlA = $target_path . $name;
            $file->move($target_path, $name);
            $urlForSql = '/uploads/' . $name;

            $seguimiento = new SeguimientoAyuda();
            $seguimiento->fecha_seguimiento = $validatedData['seguimiento_fecha'];
            $seguimiento->motivo_desarrollo_de_la_intervencion = $validatedData['seguimiento_moivo'];
            $seguimiento->acuerdos_observaciones = $validatedData['seguimiento_acuerdos_observaciones'];
            $seguimiento->url_adjunto = $urlForSql;
            $seguimiento->user_id = $validatedData['user_id'];
            $seguimiento->persona_id = $validatedData['persona_id'];
            $seguimiento->save();
        }


        return back()->with('info', 'Se creo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
