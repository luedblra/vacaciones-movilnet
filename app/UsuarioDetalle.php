<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioDetalle extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "usuario_detalles";

    protected $fillable = ['id','user_id','cargo_id','area_id'];

    /**
     * pentenece a un solo usuario
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Pertenece a un cargo
     */
    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }

    /**
     * Pertenece a un area
     */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

}
