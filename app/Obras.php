<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cadenas;
use Archivos;
use Auth;
use PDF;

class Obras extends Model
{
    protected $fillable = [
        'usuario_solicito_id',
        'usuario_aprobo_id',
        'usuario_rechazo_id',
        'usuario_recibio_id', // Para entrada
        'usuario_entrego_id', // Para salia
        'epoca_id',
        'temporalidad_id',
        'tipo_objeto_id',
        'tipo_bien_cultural_id',
        'area_id',
        'responsable_id',
        'proyecto_id',
        'seo',
        'nombre',
        'autor',
        'cultura',
        'alto',
        'diametro',
        'profundidad',
        'ancho',
        'fecha_ingreso',
        'fecha_salida',
        'modalidad',
        'persona_entrego', // Para entrada
        'persona_recibio', // Para salida
        'caracteristicas_descriptivas',
        'lugar_procedencia_original',
        'forma_ingreso',
        'lugar_procedencia_actual',
        'numero_inventario',
        'estatus_año',
        'estatus_epoca',
        'año',
        'fecha_aprobacion',
        'fecha_rechazo',
        'disponible_consulta',
        'status_operativo',
    ];
    
    protected $dates = [
        'año',
        'fecha_aprobacion',
        'fecha_rechazo',
        'fecha_ingreso',
        'fecha_salida'
    ];

    public function imagenes_principales() {
        return $this->hasMany('App\ObrasImagenesPrincipales', 'obra_id', 'id');
    }
    
    protected $dispatchesEvents = [
        'saved' => \App\Events\ObraActualizadaEvent::class,
    ];

    public function setAñoAttribute($value){
        if($value){
            $this->attributes['año']    =   Carbon::parse($value);
        } else{
            $this->attributes['año']    =   NULL;
        }
    }

    public function setFechaAprobacionAttribute($value){
        if($value){
            $this->attributes['fecha_aprobacion']   =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_aprobacion']   =   NULL;
        }
    }

    public function setFechaRechazoAttribute($value){
        if($value){
            $this->attributes['fecha_rechazo']  =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_rechazo']  =   NULL;
        }
    }

    public function setFechaIngresoAttribute($value){
        if($value){
            $this->attributes['fecha_ingreso']  =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_ingreso']  =   NULL;
        }
    }

    public function setFechaSalidaAttribute($value){
        if($value){
            $this->attributes['fecha_salida']   =   Carbon::parse($value);
        } else{
            $this->attributes['fecha_salida']   =   NULL;
        }
    }

    public function getFolioAttribute(){
        $folio          =   str_pad($this->id, 4, "0", STR_PAD_LEFT);

        if($this->fecha_ingreso){
            $folio      .=  "-".$this->fecha_ingreso->format('y')."/";
        }else{
            $folio      .=  "-00/";
        }

        $folio          .=  $this->forma_ingreso."-";

        if($this->modalidad){
            $folio      .=  Cadenas::obtenerSiglasDeCadena($this->modalidad)."-";
        }

        if($this->area){
            $folio      .=  $this->area->siglas;
        }


        // return $this->id."-20/INT-STRPM";
        return $folio;
    }

    public function usuario_aprobo() {
        return $this->hasOne('App\User', 'id', 'usuario_aprobo_id');
    }

    public function usuario_rechazo() {
        return $this->hasOne('App\User', 'id', 'usuario_rechazo_id');
    }

    public function usuario_solicito() {
        return $this->hasOne('App\User', 'id', 'usuario_solicito_id');
    }

    public function usuario_recibio() {
        return $this->hasOne('App\User', 'id', 'usuario_recibio_id');
    }

    public function usuario_entrego() {
        return $this->hasOne('App\User', 'id', 'usuario_entrego_id');
    }

    public function epoca() {
        return $this->hasOne('App\ObrasEpoca', 'id', 'epoca_id');
    }

    public function temporalidad() {
        return $this->hasOne('App\ObrasTemporalidad', 'id', 'temporalidad_id');
    }

    public function tipo_objeto() {
        return $this->hasOne('App\ObrasTipoObjeto', 'id', 'tipo_objeto_id');
    }

    public function tipo_bien_cultural() {
        return $this->hasOne('App\ObrasTipoBienCultural', 'id', 'tipo_bien_cultural_id');
    }

    public function area() {
        return $this->hasOne('App\Areas', 'id', 'area_id');
    }

    public function proyecto() {
        return $this->hasOne('App\Proyectos', 'id', 'proyecto_id');
    }

    public function solicitudes_analisis() {
        return $this->hasMany('App\ObrasSolicitudesAnalisis', 'obra_id', 'id');
    }

    public function responsables_asignados() {
        return $this->hasManyThrough(
            'App\User',
            'App\ObrasResponsablesAsignados',
            'obra_id', // Llave foranea de primer tabla con segunda tabla
            'id', // Llave foranea de segunda tabla con tercera tabla
            'id', // llave foranea de segunda tabla con primera tabla
            'usuario_id' // llave foranea de tercera tabla con segunda tabla
        );
    }

    public function temporadas_trabajo_asignadas() {
        return $this->hasManyThrough(
            'App\ProyectosTemporadasTrabajo',
            'App\ObrasTemporadasTrabajoAsignadas',
            'obra_id', // Llave foranea de primer tabla con segunda tabla
            'id', // Llave foranea de segunda tabla con tercera tabla
            'id', // llave foranea de segunda tabla con primera tabla
            'proyecto_temporada_trabajo_id' // llave foranea de tercera tabla con segunda tabla
        );
    }

    public function usuarios_asignados() {
        return $this->hasManyThrough(
            'App\User',
            'App\ObrasUsuariosAsignados',
            'obra_id', // Llave foranea de primer tabla con segunda tabla
            'id', // Llave foranea de segunda tabla con tercera tabla
            'id', // llave foranea de segunda tabla con primera tabla
            'usuario_id' // llave foranea de tercera tabla con segunda tabla
        );
    }

    public function etiquetaFolio(){
        $clase              =   "";
        $tooltip            =   "";

        if($this->status_operativo == "Deshabilitado"){
            $clase          =   "danger";
            $tooltip        =   $this->status_operativo;
        } else{
            if ($this->disponible_consulta) {
                $clase      =   "primary";
                $tooltip    =   "Disponible para consulta";
            } else{
                $tooltip    =   "NO disponible para consulta";
            }
            
        }

        return "<span class='label label-".$clase."' mi-tooltip='".$tooltip."' data-placement='right'>".$this->folio."</span>";
    }

    public function etiquetaStatus(){
        $clase          =   "";

        if($this->fecha_rechazo){
            $clase      =   "danger";
            $texto      =   "Solicitud rechazada el: ".$this->fecha_rechazo->format('Y-m-d h:i A');
        } else{
            $clase      =   "success";
            $texto      =   "Solicitud solicitada el: ".$this->created_at->format('Y-m-d h:i A');
        }

        return "<span class='label label-".$clase."' mi-tooltip='".$texto."' data-placement='right'>".$this->nombre."</span>";
    }

    public function tieneImagenFrontal(){
        return ($this->vista_frontal_grande != "" && $this->vista_frontal_chica != "");
    }

    // public function subirImagenVistaFrontal($file){
    //     $extension                          =   $file->extension();

    //     // Eliminamos posibles imagenes anteriores
    //     Archivos::eliminarArchivo("img/obras/".$this->vista_frontal_grande);
    //     Archivos::eliminarArchivo("img/obras/".$this->vista_frontal_chica);


    //     $resultadoImagenGrande              =   Archivos::subirImagen($file, $this->id."_frontal_grande.".$extension, "img/obras", 1200);
    //     $resultadoImagenChica               =   Archivos::subirImagen($file, $this->id."_frontal_chica.".$extension, "img/obras", 400);

    //     // Si alguna de las imagenes no se subio eliminamos las dos, debido que no podemos dejar una si y otra no
    //     if($resultadoImagenChica != "" || $resultadoImagenGrande != ""){
    //         // Eliminar imagenes
    //         Archivos::eliminarArchivo("img/obras/".$this->vista_frontal_grande);
    //         Archivos::eliminarArchivo("img/obras/".$this->vista_frontal_chica);

    //         $this->vista_frontal_grande     =   "";
    //         $this->vista_frontal_chica      =   "";
    //     } else{
    //         $this->vista_frontal_grande     =   $this->id."_frontal_grande.".$extension;
    //         $this->vista_frontal_chica      =   $this->id."_frontal_chica.".$extension;
    //     }

    //     $this->save();
    // }

    // public function tieneImagenPosterior(){
    //     return ($this->vista_posterior_grande != "" && $this->vista_posterior_chica != "");
    // }

    // public function subirImagenVistaPosterior($file){
    //     $extension                              =   "jpg";

    //     $resultadoImagenGrande                  =   Archivos::subirImagen($file, $this->id."_posterior_grande.".$extension, "img/obras", 1200);
    //     $resultadoImagenChica                   =   Archivos::subirImagen($file, $this->id."_posterior_chica.".$extension, "img/obras", 400);

    //     // Si alguna de las imagenes no se subio eliminamos las dos, debido que no podemos dejar una si y otra no
    //     if($resultadoImagenChica != "" || $resultadoImagenGrande != ""){
    //         // Eliminar imagen

    //         $this->vista_posterior_grande       =   "";
    //         $this->vista_posterior_chica        =   "";
    //     } else{
    //         $this->vista_posterior_grande       =   $this->id."_posterior_grande.".$extension;
    //         $this->vista_posterior_chica        =   $this->id."_posterior_chica.".$extension;
    //     }

    //     $this->save();
    // }

    // public function tieneImagenLateralIzquierda(){
    //     return ($this->vista_lateral_izquierda_grande != "" && $this->vista_lateral_izquierda_chica != "");
    // }

    // public function subirImagenVistaLateralIzquierda($file){
    //     $extension                                      =   "jpg";

    //     $resultadoImagenGrande                          =   Archivos::subirImagen($file, $this->id."_lateral_izquierda_grande.".$extension, "img/obras", 1200);
    //     $resultadoImagenChica                           =   Archivos::subirImagen($file, $this->id."_lateral_izquierda_chica.".$extension, "img/obras", 400);

    //     // Si alguna de las imagenes no se subio eliminamos las dos, debido que no podemos dejar una si y otra no
    //     if($resultadoImagenChica != "" || $resultadoImagenGrande != ""){
    //         // Eliminar imagen

    //         $this->vista_lateral_izquierda_grande       =   "";
    //         $this->vista_lateral_izquierda_chica        =   "";
    //     } else{
    //         $this->vista_lateral_izquierda_grande       =   $this->id."_lateral_izquierda_grande.".$extension;
    //         $this->vista_lateral_izquierda_chica        =   $this->id."_lateral_izquierda_chica.".$extension;
    //     }

    //     $this->save();
    // }

    // public function tieneImagenLateralDerecha(){
    //     return ($this->vista_lateral_derecha_chica != "" && $this->vista_lateral_derecha_grande != "");
    // }

    // public function subirImagenVistaLateralDerecha($file){
    //     $extension                                  =   "jpg";

    //     $resultadoImagenGrande                      =   Archivos::subirImagen($file, $this->id."_lateral_derecha_grande.".$extension, "img/obras", 1200);
    //     $resultadoImagenChica                       =   Archivos::subirImagen($file, $this->id."_lateral_derecha_chica.".$extension, "img/obras", 400);

    //     // Si alguna de las imagenes no se subio eliminamos las dos, debido que no podemos dejar una si y otra no
    //     if($resultadoImagenChica != "" || $resultadoImagenGrande != ""){
    //         // Eliminar imagen

    //         $this->vista_lateral_derecha_grande     =   "";
    //         $this->vista_lateral_derecha_chica      =   "";
    //     } else{
    //         $this->vista_lateral_derecha_grande     =   $this->id."_lateral_derecha_grande.".$extension;
    //         $this->vista_lateral_derecha_chica      =   $this->id."_lateral_derecha_chica.".$extension;
    //     }

    //     $this->save();
    // }

    public static function buscarObraValidandoPermisos($obra_id){
        $obra           =   Obras::selectRaw("obras.*")
                                    ->where('obras.id', $obra_id);

        if(!Auth::user()->rol->acceso_a_lista_solicitudes_obras){

            $obra       =   $obra->leftJoin('obras__usuarios_asignados as oua',         'oua.obra_id',  'obras.id')
                                    ->leftJoin('obras__responsables_asignados as ora',  'ora.obra_id',  'obras.id')
                                    ->where(function($query){
                                        $query->orWhere('obras.area_id', Auth::user()->area_id ?? 0);
                                        $query->orWhere(function($query2){
                                            $query2->where('oua.usuario_id', Auth::id());
                                            $query2->where('oua.status', "Activo");
                                        });
                                        $query->orWhere('ora.usuario_id', Auth::id());
                                    });
        }

        $obra           =   $obra->first();
        return $obra;
    }

    public function generarPdf(){
        $pdf = PDF::loadView('pdf.obra', ["obra" => $this]);
        return $pdf;
    }

    public function generarPdfOficio(){
        $configuracion  =   Configuraciones::first();
        $pdf            =   PDF::loadView('pdf.obra-oficio', ["obra" => $this, "configuracion" => $configuracion]);
        return $pdf;
    }

    public function generarPdfOficioSalida(){
        $configuracion  =   Configuraciones::first();
        $pdf            =   PDF::loadView('pdf.obra-oficio-salida', ["obra" => $this, "configuracion" => $configuracion]);
        return $pdf;
    }

    public static function obtenerObrasDashboard(){
        if (Auth::user()->rol->acceso_a_lista_solicitudes_obras) {
            return  Obras::selectRaw("
                                        obras.*,
                                        a.nombre    as nombre_area
                                    ")
                            ->join('areas as a', 'a.id', 'obras.area_id')
                            ->whereNotNull('obras.fecha_aprobacion')
                            ->where('obras.status_operativo', 'Habilitado')
                            ->orderBy('obras.fecha_aprobacion', 'DESC')
                            ->limit(10);
        } else{
            return  Obras::selectRaw("
                                        obras.*,
                                        a.nombre    as nombre_area
                                    ")
                            ->join('areas as a', 'a.id', 'obras.area_id')
                            ->leftJoin('obras__usuarios_asignados as asignados', 'asignados.obra_id', 'obras.id')
                            ->whereNotNull('obras.fecha_aprobacion')
                            ->where(function($query){
                                $query->orWhere('asignados.usuario_id', Auth::id());

                                if (Auth::user()->area_id) {
                                    $query->orWhere('a.id', Auth::user()->area_id);
                                }
                            })
                            ->where('obras.status_operativo', 'Habilitado')
                            ->groupBy('obras.id')
                            ->orderBy('asignados.created_at', 'DESC');
        }
    }

    public function generaSeo(){
        $this->seo  =   Cadenas::generarSeo($this->nombre, $this->id);

        return static::withoutEvents(function () {
            return $this->save();
        });
    }

    public function cadenaDimensiones(){
        return $this->alto." cm x ".$this->ancho." cm x ".($this->profundidad ?? 0)." cm x ".($this->diametro ?? 0)." cm";
    }

    public static function consulta($busqueda, $tipo, $filtros){
        // dd($busqueda, $tipo, $filtros);
        switch ($tipo) {
            default:

            case 'Tipo objeto':
                $obras      =   Obras::selectRaw("  DISTINCT
                                                    obras.*
                                                ")
                                ->join("obras__tipo_objeto as tipo", "tipo.id", "obras.tipo_objeto_id")
                                ->join('areas', 'areas.id', 'obras.area_id')
                                ->join('proyectos', 'proyectos.id', 'obras.proyecto_id')
                                ->leftJoin('obras__tipo_objeto_tesauros as tipo_tesauro', 'tipo_tesauro.tipo_objeto_id', 'tipo.id');
                
                $obras->where(function( $query ) use ($busqueda) {
                    $query->where('tipo.nombre', 'like', '%'.$busqueda.'%')
                        ->orWhere('tipo_tesauro.nombre', 'like', '%'.$busqueda.'%');
                });

                if (is_array($filtros)) {
                    $obras = Obras::filtrosAdministrativos($filtros, $obras);
                }

                // dd($obras->toSql());
                break;

            case 'Titulo':
                $obras      =   Obras::selectRaw("
                                                    DISTINCT
                                                    obras.*
                                                ")
                                    ->join('areas', 'areas.id', 'obras.area_id')
                                    ->join('proyectos', 'proyectos.id', 'obras.proyecto_id')
                                    ->where('obras.nombre', 'like', '%'.$busqueda.'%');

                if (is_array($filtros)) {
                    $obras = Obras::filtrosAdministrativos($filtros, $obras);
                }

                // dd($obras->toSql());
                break;

            case 'Autor o cultura':
                $obras      =   Obras::selectRaw("
                                                    DISTINCT
                                                    obras.*
                                                ")
                                    ->join('areas', 'areas.id', 'obras.area_id')
                                    ->join('proyectos', 'proyectos.id', 'obras.proyecto_id')
                                    ->where(function($query) use($busqueda){
                                        $query->orWhere('autor', 'like', '%'.$busqueda.'%');
                                        $query->orWhere('cultura', 'like', '%'.$busqueda.'%');
                                    });

                if (is_array($filtros)) {
                    $obras = Obras::filtrosAdministrativos($filtros, $obras);
                }

                break;

            case 'Material':
                $obras      =   Obras::selectRaw("
                                                    DISTINCT
                                                    obras.*
                                                ")
                                    ->join('areas', 'areas.id', 'obras.area_id')
                                    ->join('proyectos', 'proyectos.id', 'obras.proyecto_id')

                                    ->join("obras__solicitudes_analisis as solicitud", "solicitud.obra_id", "obras.id")
                                    ->join("obras__solicitudes_analisis_muestras as muestra", "muestra.solicitud_analisis_id", "solicitud.id")
                                    ->join("obras__resultados_analisis as resultado", "resultado.solicitudes_analisis_muestras_id", "muestra.id")
                                    ->join("obras__tipo_material as tipo", "tipo.id", "resultado.tipo_material_id")
                                    ->where('tipo.nombre', 'like', '%'.$busqueda.'%');
                                    // ->groupBy('obras.id')

                if (is_array($filtros)) {
                    $obras = Obras::filtrosAdministrativos($filtros, $obras);
                }

                break;
            case 'Técnica analítica':
                $obras      =   Obras::selectRaw("
                                                    DISTINCT
                                                    obras.*
                                                ")
                                    ->join('areas', 'areas.id', 'obras.area_id')
                                    ->join('proyectos', 'proyectos.id', 'obras.proyecto_id')

                                    ->join("obras__solicitudes_analisis as solicitud", "solicitud.obra_id", "obras.id")
                                    ->join("obras__solicitudes_analisis_muestras as muestra", "muestra.solicitud_analisis_id", "solicitud.id")
                                    ->join("obras__resultados_analisis as resultado", "resultado.solicitudes_analisis_muestras_id", "muestra.id")
                                    ->join("obras__analisis_a_realizar_resultados as analisis_realizar_resultado", "analisis_realizar_resultado.resultado_analisis_id", "resultado.id")
                                    ->join("obras__analisis_a_realizar_tecnica as tecnica", "tecnica.id", "analisis_realizar_resultado.tecnica_analitica_id")
                                    ->where('tecnica.nombre', 'like', '%'.$busqueda.'%');
                                    // ->groupBy('obras.id')
                
                if (is_array($filtros)) {
                    $obras = Obras::filtrosAdministrativos($filtros, $obras);
                }

                break;
        }

        if (Auth::user()->rol->esExterno()) {
            $obras          =   $obras->where('disponible_consulta', 1);
        }

        return $obras->whereNotNull('obras.fecha_aprobacion')
                    ->orderBy('obras.created_at', 'DESC')
                    ->get();
    }

    public static function filtrosAdministrativos($filtros, $obras)
    {
        if (is_array($filtros)) {
            if ($filtros['no_registro'] != '') {
                $obras->where('obras.id', $filtros['no_registro']);
            }

            if ($filtros['responsable_ecro'] != '') {
                $obras->join("obras__responsables_asignados as responsables", "responsables.obra_id", "obras.id")
                        ->join('users', 'users.id', 'responsables.usuario_id')
                        ->where('users.id', '=', $filtros['responsable_ecro']);
            }

            if ($filtros['area'] != '') {
                $obras->where('obras.area_id', '=', $filtros['area']);
            }

            if ($filtros['temporada'] != '') {
                $obras->join('proyectos__temporadas_trabajo as temporada', 'temporada.proyecto_id', 'proyectos.id')
                        ->where('temporada.id', '=', $filtros['temporada']);
            }

            if ($filtros['no_proyecto'] != '') {
                $obras->whereRaw("
                                    CONCAT(
                                        LPAD(proyectos.id, 4, '0'),
                                        '-',
                                        proyectos.forma_ingreso,
                                        '/',
                                        IFNULL(
                                            areas.siglas,
                                            ''
                                        )
                                    ) = '".$filtros['no_proyecto']."'
                                ");
            }

            if ($filtros['proyecto'] != '') {
                $obras->where('obras.proyecto_id', '=', $filtros['proyecto']);
            }

            if ($filtros['profe_responsable'] != '') {
                $obras->where('resultado.profesor_responsable_de_analisis_id', '=', $filtros['profe_responsable']);
            }

            if ($filtros['nomenclatura_muestra'] != '') {
                $obras->where('muestra.nomenclatura', '=', $filtros['nomenclatura_muestra']);
            }

            if ($filtros['persona_realiza_analisis'] != '') {
                $obras->where('resultado.persona_realiza_analisis_id', '=', $filtros['persona_realiza_analisis']);
            }

            return $obras;
        }
    }

    public function etiquetaDimensiones(){
        return $this->alto." cm x ".$this->ancho." cm".($this->profundidad ? (" x ".$this->profundidad." cm") : "").($this->diametro ? (" x ".$this->diametro." cm") : "");
    }

    public static function obtenerObjetoTotalesDashboard(){
        $obras                          =   Obras::select(['id', 'disponible_consulta', 'forma_ingreso'])->get();
        $obj                            =   new \StdClass;

        $obj->total                     =   $obras->count();
        $obj->total_mes                 =   Obras::where('fecha_aprobacion', '>', Carbon::now()->firstOfMonth())->count();
        $obj->total_disponible          =   $obras->where('disponible_consulta')->count();
        $obj->total_no_disponible       =   $obras->where('disponible_consulta', 0)->count();
        $obj->total_externo             =   $obras->where('forma_ingreso', 'EXT')->count();
        $obj->total_interno             =   $obras->where('forma_ingreso', 'INT')->count();
        
        return $obj;
    }
}
