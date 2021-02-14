<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterialInterCruzada extends Model
{
    protected $table = 'obras__tipo_material__inter_cruzada';
    protected $fillable = [
    	'id',
    	'tipo_material_cruzada_iter_id',
    	'interpretacion_particular_cruzada_id',
    ];
}
