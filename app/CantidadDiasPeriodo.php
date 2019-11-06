<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CantidadDiasPeriodo extends Model
{
    protected $table = 'cantidad_dia_periodos';
    protected $fillable = ['id', 'cantidad_dias', 'periodo_id'];
}
