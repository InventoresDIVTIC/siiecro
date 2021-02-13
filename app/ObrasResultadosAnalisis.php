<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PDF;
use Auth;

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
    
    protected $dates = [
        'fecha_analisis',
        'fecha_aprobacion',
        'fecha_rechazo',
        'fecha_revision'
    ];

    public function imagenes_resultados_esquema_muestra() {
        return $this->hasMany('App\ObrasResultadosAnalisisEsquemaMuestra', 'resultado_analisis_id', 'id');
    }

    public function imagenes_resultados_esquema_microfotografia() {
        return $this->hasMany('App\ObrasResultadosAnalisisEsquemaMicrofotografia', 'resultado_analisis_id', 'id');
    }

    public function resultados() {
        return $this->hasMany('App\ObrasAnalisisARealizarResultados', 'resultado_analisis_id', 'id');
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

    public function tipo_material() {
        return $this->hasOne('App\ObrasTipoMaterial', 'id', 'tipo_material_id');
    }

    public function informacion_por_definir() {
        return $this->hasOne('App\ObrasTipoMaterialInformacionPorDefinir', 'id', 'informacion_por_definir_id');
    }

    public function interpretacion_particular() {
        return $this->hasOne('App\ObrasTipoMaterialInterpretacionParticular', 'id', 'interpretacion_particular_id');
    }

    public function generarPdf(){
        $pdf            =   PDF::loadView('pdf.resultado-analisis', ["resultadoAnalisis" => $this]);
        return $pdf;
    }

    public static function obtenerResultadosDashboard(){
        if (Auth::user()->rol->acceso_a_datos_avanzado) {
            return  ObrasResultadosAnalisis::selectRaw("
                                                            obras__resultados_analisis.*,
                                                            muestra.nomenclatura        as nomenclatura,
                                                            tipo_analisis.nombre        as caracterizacion
                                                        ")
                                            ->join("obras__solicitudes_analisis_muestras as muestra", "muestra.id", "obras__resultados_analisis.solicitudes_analisis_muestras_id")
                                            ->join("obras__solicitudes_analisis_tipo_analisis as tipo_analisis", "tipo_analisis.id", "muestra.tipo_analisis_id")
                                            ->orderBy("obras__resultados_analisis.fecha_analisis", "DESC")
                                            ->limit(10);
        } else{
            return  ObrasResultadosAnalisis::selectRaw("
                                                            obras__resultados_analisis.*,
                                                            muestra.nomenclatura        as nomenclatura,
                                                            tipo_analisis.nombre        as caracterizacion
                                                        ")
                                            ->join("obras__solicitudes_analisis_muestras as muestra", "muestra.id", "obras__resultados_analisis.solicitudes_analisis_muestras_id")
                                            ->join("obras__solicitudes_analisis_tipo_analisis as tipo_analisis", "tipo_analisis.id", "muestra.tipo_analisis_id")
                                            ->join('obras__usuarios_asignados as asignados', 'asignados.id', 'obras__resultados_analisis.persona_realiza_analisis_id')
                                            ->where(function($query){
                                                $query->orWhere("obras__resultados_analisis.persona_realiza_analisis_id", Auth::id());
                                                $query->orWhere("obras__resultados_analisis.usuario_creo_id", Auth::id());
                                                $query->orWhere("asignados.usuario_id", Auth::id());
                                            })
                                            ->orderBy("obras__resultados_analisis.fecha_analisis", "DESC");
        }
    }
}