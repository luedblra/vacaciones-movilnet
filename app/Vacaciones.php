<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacaciones extends Model
{
    protected $table = "vacaciones";

    protected $fillable = ['id','user_periodo_id','fecha_i','fecha_f','dias_t'];
}
