<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PatExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelPatController extends Controller
{
    public function export(){
        return Excel::download(new PatExport, 'PruebaGenerarPat.xlsx');
    }
}