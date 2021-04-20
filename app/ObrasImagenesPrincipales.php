<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasImagenesPrincipales extends Model
{
    protected $table = 'obras__imagenes_principales';
    protected $fillable = [
    	'id',
    	'obra_id',
        'imagen_grande',
        'imagen_chica',
    ];
}
