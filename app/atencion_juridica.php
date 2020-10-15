<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atencion_juridica extends Model
{
    protected $fillable = [
        'id', 'user_id', 'chequeo', 'otros_texto', 'observaciones',
    ];
}
