<?php

namespace App\Http\Controllers;

use App\Atributo;
use App\Grupo;
use App\log_session;
use App\Plan;
use App\User;
use App\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\This;

class PerfilUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach (auth()->user()->grupos as $grupos) {
            $grupo = $grupos->id;
        }


        if (auth()->user()->grupos()->exists()) {
            $grupo = $grupo;
        } else {
            $grupo = 0;
        }

        $hoy = date('Y-m-d');
        $plan = Plan::where('desde', '<=', $hoy)->where('hasta', '>=', $hoy)->where('referencia_variables', null)->first();
        if (empty($plan)) {
            $variables = Variable::paginate(10);
        } else {
            $atributoPermisos = Atributo::where('tipo', 3)->where('plan_id', $plan->id)->first();
            $variables = Variable::where('referencia_atributos', $atributoPermisos->id)->where('variable', $grupo)->paginate(10);
        }

        $homeController = new HomeController();
        // $validaDataUser = $homeController->validaDataUser();
        // $viewModal = array('true' => 'hide', 'false' => 'show');

        $grup = Grupo::get();
        $grupo = array();
        foreach ($grup as $valueGrupo) {
            $grupo[$valueGrupo->titulo] = $valueGrupo->titulo;
        }

        $tipoDocument = array('CC' => 'CC - Cédula de ciudadanía', 'CE' => 'CE - Cédula de extranjería', 'PA' => 'PA - Pasaporte');

        return view('perfilUsuario.index', compact('plan', 'variables', 'hoy', 'grupo', 'tipoDocument'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userId = \Auth::id();
        if ($request->input('pass') != '') {
            $validatedData = $request->validate([
                'tipo_Documento' => 'required',
                'document' => 'required|min:6',
                'nombres' => 'required|min:10',
                'dependencia' => 'required',
                'fin_de_contrato' => 'required',
                'movil' => 'required',
                'pass' => 'string|min:8',
            ]);

            User::where('id', $userId)->update([
                'tipoDocumento' => $validatedData['tipo_Documento'],
                'documento' => $validatedData['document'],
                'name' => $validatedData['nombres'],
                'dependencia' => $validatedData['dependencia'],
                'finContrato' => $validatedData['fin_de_contrato'],
                'movil' => $validatedData['movil'],
                'password' => Hash::make($request->input('pass')),

            ]);
        } else {
            $validatedData = $request->validate([
                'tipo_Documento' => 'required',
                'document' => 'required|min:6',
                'nombres' => 'required|min:10',
                'dependencia' => 'required',
                'fin_de_contrato' => 'required',
                'movil' => 'required',
            ]);

            User::where('id', $userId)->update([
                'tipoDocumento' => $validatedData['tipo_Documento'],
                'documento' => $validatedData['document'],
                'name' => $validatedData['nombres'],
                'dependencia' => $validatedData['dependencia'],
                'finContrato' => $validatedData['fin_de_contrato'],
                'movil' => $validatedData['movil'],
            ]);
        }
        $file = $request->file('file_Acuerdo');
        //dd($file->getClientOriginalName());
        if ($request->file('file_Acuerdo') != '') {
            $urlFile = str_replace(' ', '_', $file->getClientOriginalName());
            $target_path = '/home/comvictimas/public_html/uploads/';
            $file->move( $target_path, str_replace(' ', '_', $file->getClientOriginalName()));
            User::where('id', $userId)->update([
                'copiaContrato' => $urlFile,
            ]);
        }



        return redirect('/home');
    }

    public function estadoUser($id)
    {
        $espuesta = $this->cambiarEstadoUser($id);
        return back()->with(compact('espuesta'));
    }

    public function cambiarEstadoUser($id)
    {
        $estado = User::where('id', $id)->first();
        if ($estado->estado != '1') {
            User::where('id', $id)->update([
                'estado' => '1'
            ]);
            return 'Activo';
        } else {
            User::where('id', $id)->update([
                'estado' => '0'
            ]);
            return 'Desactivo';
        }
    }
}
