<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atributo;
use App\Grupo;
use App\log_session;
use App\Variable;
use App\Plan;
use App\User;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    if ($this->validatFinContrato()) {
      //$planes = Plan::where()
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
        $variables = Variable::get();
      } else {
        $atributoPermisos = Atributo::where('tipo', 3)->where('plan_id', $plan->id)->first();
        $variables = Variable::where('referencia_atributos', $atributoPermisos->id)->where('variable', $grupo)->get();
      }
      $id_user = Auth::id();
      $contar_sessiones = log_session::where('id_user', $id_user)->get()->pluck('id')->count();
      $ultima_session_date = log_session::where('id_user', $id_user)->orderby('created_at', 'DESC')->first();
      $ultima_session_date = log_session::where('id_user', $id_user)->where('tipo', '1')->where('id', '<', $ultima_session_date['id'])->orderby('created_at', 'DESC')->first()->toArray();
      $ultima_session_date = date('d M', strtotime($ultima_session_date['created_at'] . "- 5 hours"));

      $validaDataUser = $this->validaDataUser();
      $viewModal = array('true' => 'hide', 'false' => 'show');

      $grup = Grupo::get();
      $grupo = array();
      foreach ($grup as $valueGrupo) {
        $grupo[$valueGrupo->titulo] = $valueGrupo->titulo;
      }

      $tipoDocument = array('CC' => 'CC - Cédula de ciudadanía', 'CE' => 'CE - Cédula de extranjería', 'PA' => 'PA - Pasaporte');

      return view('home', compact('plan', 'variables', 'hoy', 'contar_sessiones', 'ultima_session_date', 'validaDataUser', 'viewModal', 'grupo', 'tipoDocument'));
    } else {
      if ($this->middleware('guest')->except('logout')) {
        \Auth::logout();
        $messageDisableUser = 'Usted ya termino su contrato, esperamos su pronta renovacion. Gracias.';
        return redirect('/')->with(compact('messageDisableUser'));
      }
    }
  }

  public function gestion()
  {
    $atributos = Atributo::get();
    $variables = Variable::whereNull('parent_id')->get();
    $variablex = Variable::whereNotNull('parent_id')->get();
    return view('gestion', compact('atributos', 'variables', 'variablex'));
  }

  public function ayuda()
  {
    if (auth()->user()->grupos()->exists()) {
      $grupo = auth()->user()->grupos[0]->id;
    } else {
      $grupo = 0;
    }
    $variables = Variable::where('tipo', 15)->get();
    $aPermisos = Atributo::where('plan_id', 1)->where('tipo', 3)->first();
    $permisos = Variable::where('referencia_atributos', $aPermisos->id)->where('variable', $grupo)->pluck('parent_id')->toArray();

    $permisos = $variables->only($permisos)->pluck('variable', 'id')->toArray();
    dd($permisos);

    return view('ayuda');
  }

  // aceptacion de confidencialidad
  public function acepConfidencialidad(Request $request)
  {
    $validatedData = $request->validate([
      'acepta' => ['required'],
    ]);
    $userId = \Auth::id();
    if ($validatedData['acepta'] == 'no') {
      \Auth::logout();
      $clientIP = \Request::ip();
      $log_session = new log_session();
      $log_session->id_user = $userId;
      $log_session->ip_user = $clientIP;
      $log_session->tipo = '0';
      $log_session->save();
      return redirect('/');
    } else {
      User::where('id', $userId)->update([
        'acepConfidencialidad' => $validatedData['acepta'],
        'acepConfidencialidadDate' => now()->format('Y-m-d'),
      ]);

      // $validaDataUser = 'true';
      // $viewModal = array('true' => 'hide', 'false' => 'show');
      // return redirect()->route('personas.index');
      return back();
    }
  }

  // actualizacion de datos personales
  public function actuDataUser(Request $request)
  {
    $validatedData = $request->validate([
      'tipo_Documento' => 'required',
      'document' => 'required|min:6',
      'nombres' => 'required|min:10',
      'dependencia' => 'required',
      'contrato' => ['required'],
      'fin_de_contrato' => 'required',
      'movil' => 'required',
    ]);
    $userId = \Auth::id();
    User::where('id', $userId)->update([
      'tipoDocumento' => $validatedData['tipo_Documento'],
      'documento' => $validatedData['document'],
      'name' => $validatedData['nombres'],
      'dependencia' => $validatedData['dependencia'],
      'tipoContrato' => $validatedData['contrato'],
      'finContrato' => $validatedData['fin_de_contrato'],
      'movil' => $validatedData['movil'],
    ]);

    return redirect()->route('perfil.index');
  }

  // validar si el usuario ya iene sus datos en la tabla user
  public function validaDataUser()
  {
    $idUser = Auth::id();
    $respon = DB::select('CALL `validaUserComplet`(' . $idUser . ')');
    foreach ($respon as  $valueRes) {
      $respon = $valueRes->respuesta;
    }
    return $respon;
  }

  public function validatFinContrato()
  {
    $idUser = Auth::id();
    if (Auth::user()->tipoContrato == 'CONTRATISTA') {
      $user = User::where('id', $idUser)->where('tipoContrato', 'CONTRATISTA')->get();
      foreach ($user as $keyUser => $valueUser) {
        $finContrato = $valueUser->finContrato;
      }
      // dd($finContrato);

      $now  = Carbon::now()->subDays(1);
      $end  = $finContrato;
      (int) $diasRestantes = $now->diffInDays($end);
      // dd($diasRestantes);

      if ($diasRestantes <= 0) {
        User::where('id', $idUser)->update([
          'estado' => '0',
        ]);
        return false;
      }
    }

    if (auth()->user()->estado == '0') {
      return false;
    }
    return true;
  }

  public function documentoConfidencialidad()
  {
    $now  = Carbon::now()->format('d/m/Y');
    $dia = Carbon::now()->format('d');
    $mes = Carbon::now()->format('m');
    $ano = Carbon::now()->format('Y');
    $fechaFor = $dia . ' días del mes de ' . $mes . ' de ' . $ano;

    return view('confidencialidad.pdf', compact('now', 'fechaFor'));
  }

  public function descargarPdfConfidencialidad()
  {
    $idUser = \Auth::id();
    $data = array('hola');
    $now  = Carbon::now()->format('d/m/Y');
    $dia = Carbon::now()->format('d');
    $mes = Carbon::now()->format('m');
    $ano = Carbon::now()->format('Y');
    $fechaFor = $dia . ' días del mes de ' . $mes . ' del ' . $ano;
    $nombre = Auth::user()->documento . 'Confidencialidad.pdf';
    $pdf = PDF::loadView('confidencialidad.pdf', compact('data', 'now', 'fechaFor'))->setPaper('a4', 'portrait')->setWarnings(false);

    $userId = \Auth::id();
    User::where('id', $userId)->update([
      'yaCargoInfoUser' => '1',
    ]);

    return $pdf->download($nombre);
  }

}
