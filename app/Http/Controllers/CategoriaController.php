<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }

    // CRUD para Tipos de Acciones en los atributos del tipo identificación


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAcciones()
    {
        //
        $categorias = Categoria::where('tipo',2)->paginate(5);

        return view('tiposAcciones.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearAcciones()
    {
        //
        return view('tiposAcciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarAcciones(Request $request)
    {
        //
        $this->validate($request,[
            'titulo' => 'required',

        ]);

        $categoria = new Categoria;
        $categoria->titulo = $request->titulo;
        $categoria->tipo = 2;
        $categoria->save();

        return redirect()->route('categorias.indexAcciones')
                    ->with('info','Tipo de Accion creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function verAcciones(Categoria $accion)
    {
        //
        return view('tiposAcciones.show',compact('accion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function editarAcciones(Categoria $accion)
    {
        //

        return view('tiposAcciones.edit',compact('accion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function actualizarAcciones(Request $request, Categoria $accion)
    {
        //
        $this->validate($request,[
            'titulo' => 'required',

        ]);

        $accion->update($request->all());


        return redirect()->route('categorias.indexAcciones')
                    ->with('info','Tipo Accion editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function eliminarAcciones(Categoria $accion)
    {

        $accion->delete();

        return back()->with('info','Tipo de Accion eliminada con exito');
    }


}
