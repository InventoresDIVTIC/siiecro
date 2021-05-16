<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasAnalisisARealizarInformacionDelEquipo extends Model
{
    protected $table = 'obras__analisis_a_realizar_informacion_del_equipo';
    protected $fillable = [
    	'id',
    	'nombre',
    ];
}
