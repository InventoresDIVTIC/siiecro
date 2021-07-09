<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterialInterpretacionParticularTesauros extends Model
{
    protected $table    = "obras__tipo_material__interpretacion_particular_tesauros";
    protected $fillable = [
        'tipo_material_interpretacion_particular_id',
        'nombre',
    ];
}
