<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObrasAnalisisARealizarResultados extends Model
{
    protected $table = 'obras__analisis_a_realizar_resultados';
    protected $fillable = [
    	'id',
    	'resultado_analisis_id',
    	'analisis_a_realizar_id',
    	'tecnica_analitica_id',
    	'interpretacion',
    	// 'descripciones',
    	// 'datos',
    	'info_del_equipo_id',
    	'ruta_acceso_imagen',
    	// 'ruta_acceso_datos',
        // AGREGADO DE ULTIMA HORA (UN CAMBIO MÁS)
        'informacion_por_definir_id',
    ];

    public function esquema_analiticos_microfotografias() {
        return $this->hasMany('App\ObrasAnalisisARealizarMicrofotografia', 'analisis_a_realizar_resultado_id', 'id');
    }

    public function analisis_realizar() {
        return $this->hasOne('App\ObrasAnalisisARealizar', 'id', 'analisis_a_realizar_id');
    }

    public function tecnica_analitica() {
        return $this->hasOne('App\ObrasAnalisisARealizarTecnica', 'id', 'tecnica_analitica_id');
    }

    public function informacion_del_equipo() {
        return $this->hasOne('App\ObrasAnalisisARealizarInformacionDelEquipo', 'id', 'info_del_equipo_id');
    }

    public function informacion_por_definir() {
        return $this->hasOne('App\ObrasTipoMaterialInformacionPorDefinir', 'id', 'informacion_por_definir_id');
    }
}
