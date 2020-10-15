<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AcuerdoConfidenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('confidencialidad.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'file_Acuerdo' => 'required|mimes:pdf|max:5120'
        ]);

        $file = $request->file('file_Acuerdo');
        $urlFile = '/AcuerdoConfi/' . str_replace(' ', '', $file->getClientOriginalName());
        //dd('/home/comvictimas/public_html/uploads/AcuerdoConfi/');
        $file->move('/home/comvictimas/public_html/uploads/AcuerdoConfi/', str_replace(' ', '', $file->getClientOriginalName()));
        $idUser = Auth::id();
        User::where('id', $idUser)->update([
            'copiaContrato' => $urlFile,
        ]);

        return back();
    }

    public function buscarAcuerdo(Request $request)
    {
        $data = $request->data;
        $persona = User::where('documento', 'LIKE', "%$data%")->orWhere('name', 'LIKE', "%$data%")->orWhere('dependencia', 'LIKE', "%$data%")->count();
        $resultados = User::where('documento', 'LIKE', "%$data%")->orWhere('name', 'LIKE', "%$data%")->orWhere('dependencia', 'LIKE', "%$data%")->get();
        if ($persona != 0) {
            return view('confidencialidad.index', compact('resultados'));
        } else {
            session()->flash('mensajeE', 'Persona NO existente');
            return back();
        }
    }
}
