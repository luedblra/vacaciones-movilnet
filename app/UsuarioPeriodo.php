<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioPeriodo extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "usuario_periodos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','periodo_id'];

    /**
     * pentenece a varios usuarios
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Pertenece a un periodo
     */
    public function periodo()
    {
        return $this->belongsTo('App\Periodo');
    }
    
}
