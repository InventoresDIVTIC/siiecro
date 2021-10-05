<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    protected $table = 'configuraciones';
    protected $fillable = [
    	'id',
        'director_general',
        'director_academico',
    ];
}
