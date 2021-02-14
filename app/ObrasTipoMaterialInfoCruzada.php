<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasTipoMaterialInfoCruzada extends Model
{
    protected $table = 'obras__tipo_material__info_cruzada';
    protected $fillable = [
    	'id',
    	'tipo_material_cruzada_info_id',
    	'informacion_por_definir_cruzada_id',
    ];
}
