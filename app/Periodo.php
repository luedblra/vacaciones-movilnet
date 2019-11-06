<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'periodos';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'rango', 'dias_disp'];

    /**
     * Un area en varios (usuario periodo)
     */
    public function usuario_periodo()
    {
        return $this->hasMany('App\usuario_periodo');
    }

}
