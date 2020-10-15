<?php

namespace App\Http\Controllers;

use App\atencion_juridica;
use App\Personas;
use App\HechoVictimizante;
use App\EnfoquePoblacional;
use App\Genero;
use App\TipoPoblacion;
use App\HechoVictima;
use App\AtencionPsicosocial;
use App\Atributo;
use App\Ayudavictima;
use App\Bitacora;
use App\Gestionayuda;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CrearPersona;
use App\lista_chequeo_atencion_juridica;
use App\Plan;
use App\Seguimientoayuda;
use App\Variable;
use Illuminate\Support\Facades\DB;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('personas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentos = Categoria::where('tipo',3)->pluck('titulo', 'id')->toArray();
        $enfoqueP = EnfoquePoblacional::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $tipoP = TipoPoblacion::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $genero = Genero::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $hechosV = HechoVictimizante::orderBy('name', 'ASC')->get();
        $grados = Categoria::where('tipo',4)->pluck('titulo', 'id')->toArray();
        return view('personas.create', compact('hechosV', 'enfoqueP', 'tipoP', 'genero','documentos','grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearPersona $request)
    {
        $persona = Personas::create($request->all());
        foreach($request->hechosV as $hechos)
        {
          $hecho = new HechoVictima();
          $hecho->persona_id = $persona->id;
          $hecho->hechoV_id = $hechos;
          $hecho->save();
        }


        session()->flash('info', 'Persona registrada con éxito!');
        return redirect()->route('personas.show', $persona->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function show(Personas $personas)
    {
      $persona = DB::table('personas')
                   ->join('generos', 'personas.genero_id', '=', 'generos.id')
                   ->select('personas.*', 'generos.name')
                   ->where('personas.id', '=', $personas->id)
                   ->first();
      $enfoque = DB::table('personas')
                   ->join('enfoque_poblacionals', 'personas.enfoqueP_id', '=', 'enfoque_poblacionals.id')
                   ->select('enfoque_poblacionals.name')
                   ->where('personas.id', '=', $personas->id)
                   ->first();
      $tipo = DB::table('personas')
                   ->join('tipo_poblacions', 'personas.tipoP_id', '=', 'tipo_poblacions.id')
                   ->select('tipo_poblacions.name')
                   ->where('personas.id', '=', $personas->id)
                   ->first();
      $hecho = DB::table('hecho_victimas')
                 ->join('personas', 'hecho_victimas.persona_id', '=', 'personas.id')
                 ->join('hecho_victimizantes', 'hecho_victimas.hechoV_id', '=', 'hecho_victimizantes.id')
                 ->select('hecho_victimizantes.name')
                 ->where('personas.id', '=', $personas->id)
                 ->get();
        $atenciones = DB::table('atencions')
              ->join('personas', 'atencions.persona_id', '=', 'personas.id')
              ->join('variables', 'atencions.accion_id', '=', 'variables.id')
              ->select('variables.variable', 'atencions.id', 'atencions.fecha', 'atencions.descripcion')
              ->where('atencions.persona_id', '=', $persona->id)
              ->where('variables.referencia_atributos','=', '17')
              ->get();
        $atencionP = DB::table('atencion_psicosocials')
                       ->join('personas', 'atencion_psicosocials.persona_id', '=', 'personas.id')
                       ->select('atencion_psicosocials.id', 'atencion_psicosocials.fechaAtencion')
                       ->where('atencion_psicosocials.persona_id', '=', $persona->id)
                       ->get();
        $beneficiarios = DB::table('beneficiarios')
                        ->join('personas', 'personas.id', '=', 'beneficiarios.persona_id')
                        ->select('beneficiarios.primerNombre', 'beneficiarios.primerApellido', 'beneficiarios.id')
                        ->where('personas.id', '=', $personas->id)
                        ->get();
        $documentos = DB::table('categorias')
                          ->join('personas','personas.tipoDoc','=','categorias.id')
                          ->select('categorias.titulo','categorias.id')
                          ->where('categorias.id', '=', $personas->tipoDoc)
                          ->first();
        $enfoqueP = EnfoquePoblacional::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $genero = Genero::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $registro_ayudas = Ayudavictima::where('persona_id', $persona->id)->get();
        $ayudas = Gestionayuda::get()->toArray();
        $hoy = date('Y-m-d');
        $plan = Plan::where('desde', '<=', $hoy)->where('hasta', '>=', $hoy)->where('referencia_variables', null)->first();
        if (empty($plan)) {
          $acciones = 0;
        } else {
          $atrubuto = Atributo::where('tipo', 2)->where('plan_id', $plan->id)->first();
          $acciones = Variable::where('referencia_atributos', $atrubuto->id)->where('tipo', '19')->where('estado', '1')->get()->pluck('variable','id')->toarray();
        }
        //$atrubuto = Atributo::where('tipo', 2)->first();
        //$acciones = Variable::where('referencia_atributos', $atrubuto->id)->where('tipo', '19')->where('estado', '1')->get()->pluck('variable','id')->toarray();
        $planes = Plan::get()->pluck('variable','id')->toarray();
        $tipoDocumentos = Categoria::where('tipo',3)->pluck('titulo', 'id')->toArray();

        $grados = Categoria::where('tipo',4)->pluck('titulo', 'id')->toArray();
        //$seguimientos= Seguimientoayuda::where('persona_id', $persona->id)->get();
        $seguimientos = DB::table('seguimiento_ayudas')->where('persona_id', $persona->id)->get();
        $aten_juri_lista_chequeo = lista_chequeo_atencion_juridica::where('estado', '1')->get()->pluck('titulo', 'id')->toArray();
        $aten_juridicas = atencion_juridica::where('persona_id', $persona->id)->get();
        $Bitacora = Bitacora::where('persona_id', $persona->id)->get();
        return view('personas.show', compact('tipoDocumentos','documentos','persona', 'hecho', 'enfoque', 'tipo', 'atenciones', 'atencionP', 'enfoqueP', 'genero', 'beneficiarios', 'registro_ayudas', 'ayudas', 'acciones', 'planes', 'seguimientos', 'aten_juri_lista_chequeo', 'aten_juridicas','grados','personas', 'Bitacora'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function edit(Personas $personas)
    {

      $hecho = DB::table('hecho_victimas')
                 ->join('personas', 'hecho_victimas.persona_id', '=', 'personas.id')
                 ->join('hecho_victimizantes', 'hecho_victimas.hechoV_id', '=', 'hecho_victimizantes.id')
                 ->select('hecho_victimizantes.id')
                 ->where('personas.id', '=', $personas->id)
                 ->pluck('id')->toArray();
        $grados = Categoria::where('tipo',4)->pluck('titulo', 'id')->toArray();
        $documentos = Categoria::where('tipo',3)->pluck('titulo', 'id')->toArray();
        $enfoqueP = EnfoquePoblacional::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $tipoP = TipoPoblacion::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $genero = Genero::orderBy('name', 'ASC')->get()->pluck('name', 'id')->toArray();
        $hechosV = HechoVictimizante::orderBy('name', 'ASC')->get();
        return view('personas.edit', compact('personas', 'enfoqueP', 'tipoP', 'genero', 'hechosV','documentos','grados','hecho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personas $personas)
    {

        $persona = Personas::find($personas->id)->update($request->all());

        if(!empty($request->hechosV)){
          foreach($request->hechosV as $hechos)
          {
            $hecho = new HechoVictima();
            $hecho->persona_id = $personas->id;
            $hecho->hechoV_id = $hechos;
            $hecho->save();
          }
        }

        session()->flash('info', 'Persona actualizada con éxito!');
        return redirect()->route('personas.show', $personas->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personas  $personas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personas $personas)
    {
        //
    }

    public function search(Request $request)
    {
      $data = $request->data;
      $persona = Personas::Search($data)
                         ->count();
      $personas = Personas::Search($data)
                         ->get();
      if ($persona != 0) {
        return view('personas.resultados', compact('personas'));
      }
      else {
        session()->flash('mensajeE', 'Persona NO existente');
        return back();
      }
    }
}
