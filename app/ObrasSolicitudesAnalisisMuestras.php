<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasSolicitudesAnalisisMuestras extends Model
{
    protected $table = 'obras__solicitudes_analisis_muestras';
    protected $fillable = [
    	'id',
    	'solicitud_analisis_id',
    	'usuario_creo_id',
        'tipo_analisis_id',
    	'no_muestra',
    	'nomenclatura',
    	'informacion_requerida',
    	'motivo',
    	'descripcion_muestra',
    	'ubicacion'
    ];

    public function solicitud_analisis() {
        return $this->hasOne('App\ObrasSolicitudesAnalisis', 'id', 'solicitud_analisis_id');
    }

    public function tipo_analisis() {
        return $this->hasOne('App\ObrasSolicitudesAnalisisTipoAnalisis', 'id', 'tipo_analisis_id');
    }

    public function resultados_analisis() {
        return $this->hasOne('App\ObrasResultadosAnalisis', 'solicitudes_analisis_muestras_id', 'id');
    }
}
