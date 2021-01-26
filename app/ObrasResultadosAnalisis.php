<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PDF;

class ObrasResultadosAnalisis extends Model
{
    protected $table = 'obras__resultados_analisis';
    protected $fillable = [
    	'id',
    	'solicitudes_analisis_muestras_id',
        'forma_obtencion_muestra_id',
        'tipo_material_id',
        'informacion_por_definir_id',
        'interpretacion_particular_id',
        'profesor_responsable_de_analisis_id',
    	'persona_realiza_analisis_id',
        
        'usuario_creo_id',
        'usuario_aprobo_id',
        'usuario_rechazo_id',
        'usuario_reviso_id',

        'motivo_de_rechazo',
        'estatus',

        'fecha_aprobacion',
        'fecha_rechazo',
        'fecha_revision',
        
        'lugar_resguardo_muestra',
        'fecha_analisis',
        'ubicacion_de_toma_muestra',
        'descripcion',
        'ruta_acceso_microfotografia',
        'conclusion_general',
    ];

    public function imagenes_resultados_esquema_muestra() {
        return $this->hasMany('App\ObrasResultadosAnalisisEsquemaMuestra', 'resultado_analisis_id', 'id');
    }

    public function imagenes_resultados_esquema_microfotografia() {
        return $this->hasMany('App\ObrasResultadosAnalisisEsquemaMicrofotografia', 'resultado_analisis_id', 'id');
    }

    public function solicitud_analisis_muestra() {
        return $this->hasOne('App\ObrasSolicitudesAnalisisMuestras', 'id', 'solicitudes_analisis_muestras_id');
    }

    public function profesor_responsable_analisis() {
        return $this->hasOne('App\User', 'id', 'profesor_responsable_de_analisis_id');
    }

    public function persona_analisis() {
        return $this->hasOne('App\User', 'id', 'persona_realiza_analisis_id');
    }

    public function forma_obtencion_muestra() {
        return $this->hasOne('App\ObrasFormaObtencionMuestra', 'id', 'forma_obtencion_muestra_id');
    }

    public function generarPdf(){
        $pdf            =   PDF::loadView('pdf.resultado-analisis', ["resultadoAnalisis" => $this]);
        return $pdf;
    }
}