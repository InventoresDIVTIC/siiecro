<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterialTesauros extends Model
{
    protected $table    = "obras__tipo_material_tesauros";
    protected $fillable = [
        'tipo_material_id',
        'nombre',
    ];
}
