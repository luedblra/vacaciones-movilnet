<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{

   /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = "cargos";

   	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = ['id','nombre'];

    /**
     * Un cargo en varios (usuario detalle)
     */
    public function usuario_detalle()
    {
        return $this->hasMany('App\usuario_detalle');
    }


}
