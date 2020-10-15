<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lista_chequeo_atencion_juridica extends Model
{
    protected $fillable = [
        'id', 'user_id', 'titulo', 'estado',
    ];
}
