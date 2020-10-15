<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditThreshold = 10;

    use Notifiable;
    use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipoDocumento', 'documento', 'lugarExpedicionDocumento', 'movil', 'direcion', 'dependencia', 'tipoContrato', 'finContrato', 'copiaContrato', 'estado', 'acepConfidencialidad', 'yaCargoInfoUser',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $auditInclude = [
        'name', 'email', 'password',
    ];

      public function grupos()
    {
        return $this->belongsToMany(Grupo::class);
    }
}
