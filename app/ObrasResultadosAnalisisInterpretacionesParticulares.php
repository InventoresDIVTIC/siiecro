<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasResultadosAnalisisInterpretacionesParticulares extends Model
{
    protected $table = 'obras__resultados_analisis_interpretaciones_particulares';
    protected $fillable = [
    	'id',
    	'obras__resultados_analisis_id',
        'obras__tipo_material__interpretacion_particular_id',
    ];

    public function interpretacion_particular() {
        return $this->hasOne('App\ObrasTipoMaterialInterpretacionParticular', 'id', 'obras__tipo_material__interpretacion_particular_id');
    }
}
