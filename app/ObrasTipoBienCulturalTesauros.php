<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoBienCulturalTesauros extends Model
{
    protected $table    = "obras__tipo_bien_cultural_tesauros";
    protected $fillable = [
        'tipo_bien_cultural_id',
        'nombre',
    ];
}
