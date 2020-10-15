<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log_session extends Model
{
    protected $fillable = [
        'id', 'id_user', 'ip_user', 'tipo', 'created_at', 'updated_at',
    ];
}
