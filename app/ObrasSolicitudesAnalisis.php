<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PDF;

class ObrasSolicitudesAnalisis extends Model
{
    protected $table = 'obras__solicitudes_analisis';
    protected $fillable = [
    	'id',
    	'obra_id',
        'obra_temporada_trabajo_asignada_id',
        'creo_usuario_id',
        'usuario_aprobo_id',
        'usuario_rechazo_id',
        'usuario_reviso_id',
    	'obra_usuario_asignado_id',
        'motivo_de_rechazo',
    	'tecnica',
    	'fecha_intervencion',
        'estatus',
        'fecha_aprobacion',
        'fecha_rechazo',
        'fecha_revision',
    ];

    public function tipo_analisis() {
        return $this->hasOne('App\ObrasSolicitudesAnalisisTipoAnalisis', 'id', 'obra_id');
    }

    public function obra() {
        return $this->hasOne('App\Obras', 'id', 'obra_id');
    }

    public function obra_temporada_trabajo() {
        return $this->hasOne('App\ObrasTemporadasTrabajoAsignadas', 'id', 'obra_temporada_trabajo_asignada_id');
    }

    public function reponsable_solicitud() {
        return $this->hasOne('App\ObrasUsuariosAsignados', 'usuario_id', 'obra_usuario_asignado_id');
    }

    public function imagenes_esquema() {
        return $this->hasMany('App\ObrasSolicitudesAnalisisImagenesEsquema', 'solicitud_analisis_id', 'id');
    }

    public function muestras() {
        return $this->hasMany('App\ObrasSolicitudesAnalisisMuestras', 'solicitud_analisis_id', 'id');
    }

    public function generarPdf(){
        $muestras       =   $this->obtenerMuestrasAgrupadasPorTipo();
        $pdf            =   PDF::loadView('pdf.solicitud-analisis', ["solicitudAnalisis" => $this, "muestras" => $muestras]);
        return $pdf;
    }

    public function obtenerMuestrasAgrupadasPorTipo(){
        $muestras   =   ObrasSolicitudesAnalisisMuestras::selectRaw('
                                                                        obras__solicitudes_analisis_muestras.*,
                                                                        tipo.nombre             as nombre_tipo_analisis,
                                                                        tipo.color_hexadecimal  as color
                                                                    ')
                                                        ->join('obras__solicitudes_analisis_tipo_analisis as tipo', 'tipo.id', 'obras__solicitudes_analisis_muestras.tipo_analisis_id')
                                                        ->where('solicitud_analisis_id', $this->id)
                                                        ->get();

        $muestras   =   $muestras->groupBy('nombre_tipo_analisis');

        return $muestras;
    }
}
