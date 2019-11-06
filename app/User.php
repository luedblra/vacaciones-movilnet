<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password',
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

    /**
     * Un usuario posee varios (usuario detalle)
     */
    public function usuario_detalle()
    {
        return $this->hasOne('App\UsuarioDetalle','user_id');
    }

    /**
     * Un usuario posee varios (usuario periodo)
     */
    public function usuario_periodo()
    {
        return $this->hasMany('App\UsuarioPeriodo','user_id');
    }

}
