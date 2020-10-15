<?php

namespace App\Exports;

use DB;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Email',
        ];
    }
    public function collection()
    {
         $users = DB::table('users')->select('id','name', 'email')->get();
         return $users;
        
    }
}