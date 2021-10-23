<?php

namespace App\Imports;

use App\Areas;
use App\Obras;
use App\ObrasEpoca;
use App\ObrasTemporalidad;
use App\ObrasTipoObjeto;
use App\ObrasTipoBienCultural;
use App\ObrasResponsablesAsignados;
use App\ObrasTemporadasTrabajoAsignadas;
use App\ProyectosTemporadasTrabajo;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Auth;

class ObrasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        try {
            ###### TEMPORALIDAD ID ########################################################
                if(is_numeric($row['temporalidad_id']) || $row['temporalidad_id'] == ""){
                    $temporalidad_id                        =   $row['temporalidad_id'];
                } else{

                    // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
                    // entonces lo creamos
                    $temporalidad                           =   ObrasTemporalidad::where('nombre', 'like', '%'.$row['temporalidad_id'].'%')->first();
                    if($temporalidad){
                        $temporalidad_id                    =   $temporalidad->id;
                    } else{
                        $temporalidadN                      =   new ObrasTemporalidad;
                        $temporalidadN->nombre              =   $row['temporalidad_id'];
                        $temporalidadN->save();
                        $temporalidadN->refresh();

                        $temporalidad_id                    =   $temporalidadN->id;
                    }
                }
            ###############################################################################

            ###### AREA ID ################################################################
                if(is_numeric($row['area_id']) || $row['area_id'] == ""){
                    $area_id                                =   $row['area_id'];
                } else{

                    // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
                    // entonces lo creamos
                    $area                                   =   Areas::where('nombre', 'like', '%'.$row['area_id'].'%')->first();
                    if($area){
                        $area_id                            =   $area->id;
                    } else{
                        $areaN                              =   new Areas;
                        $areaN->nombre                      =   $row['area_id'];
                        $areaN->save();
                        $areaN->refresh();

                        $area_id                            =   $areaN->id;
                    }
                }
            ###############################################################################

            ###### EPOCA ID ###############################################################
                if(is_numeric($row['epoca_id']) || $row['epoca_id'] == ""){
                    $epoca_id                               =   $row['epoca_id'];
                } else{

                    // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
                    // entonces lo creamos
                    $epoca                                  =   ObrasEpoca::where('nombre', 'like', '%'.$row['epoca_id'].'%')->first();
                    if($epoca){
                        $epoca_id                           =   $epoca->id;
                    } else{
                        $epocaN                             =   new ObrasEpoca;
                        $epocaN->nombre                     =   $row['epoca_id'];
                        $epocaN->save();
                        $epocaN->refresh();

                        $epoca_id                           =   $epocaN->id;
                    }
                }
            ###############################################################################

            ###### TIPO OBJETO ID #########################################################
                if(is_numeric($row['tipo_objeto_id']) || $row['tipo_objeto_id'] == ""){
                    $tipo_objeto_id                          =   $row['tipo_objeto_id'];
                } else{

                    // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
                    // entonces lo creamos
                    $tipoObjeto                              =   ObrasTipoObjeto::where('nombre', 'like', '%'.$row['tipo_objeto_id'].'%')->first();
                    if($tipoObjeto){
                        $tipo_objeto_id                      =   $tipoObjeto->id;
                    } else{
                        $tipoObjetoN                         =   new ObrasTipoObjeto;
                        $tipoObjetoN->nombre                 =   $row['tipo_objeto_id'];
                        $tipoObjetoN->save();
                        $tipoObjetoN->refresh();

                        $tipo_objeto_id                      =   $tipoObjetoN->id;
                    }
                }
            ###############################################################################

            ###### TIPO BIEN CULTURAL ID ##################################################
                if(is_numeric($row['tipo_bien_cultural_id']) || $row['tipo_bien_cultural_id'] == ""){
                    $tipo_bien_cultural_id                   =   $row['tipo_bien_cultural_id'];
                } else{

                    // Buscamos una temporalidad por el nombre, si no existe un registro con el nombre
                    // entonces lo creamos
                    $tipoBienCultural                        =   ObrasTipoBienCultural::where('nombre', 'like', '%'.$row['tipo_bien_cultural_id'].'%')->first();
                    if($tipoBienCultural){
                        $tipo_bien_cultural_id               =   $tipoBienCultural->id;
                    } else{
                        $tipoBienCulturalN                   =   new ObrasTipoBienCultural;
                        $tipoBienCulturalN->nombre           =   $row['tipo_bien_cultural_id'];
                        $tipoBienCulturalN->save();
                        $tipoBienCulturalN->refresh();

                        $tipo_bien_cultural_id               =   $tipoBienCulturalN->id;
                    }
                }
            ###############################################################################

            $obra                                           =   Obras::find($row["id"]);

            if (is_null($obra)) {
                $obra                                       =   new Obras;
                $obra->id                                   =   $row["id"];
                $obra->usuario_solicito_id                  =   Auth::id();
                $obra->usuario_aprobo_id                    =   Auth::id();
                $obra->usuario_recibio_id                   =   Auth::id();
                $obra->numero_inventario                    =   $row["numero_inventario"] ?? "S/N";
                $obra->fecha_aprobacion                     =   Carbon::now();
            }

            $obra->tipo_objeto_id                           =   $tipo_objeto_id;
            $obra->tipo_bien_cultural_id                    =   $tipo_bien_cultural_id;
            $obra->epoca_id                                 =   $epoca_id;
            $obra->temporalidad_id                          =   $temporalidad_id;
            $obra->area_id                                  =   $area_id;
            $obra->proyecto_id                              =   $row["proyecto_id"];
            $obra->nombre                                   =   $row["nombre"];
            $obra->autor                                    =   $row["autor"];
            $obra->cultura                                  =   $row["cultura"];
            $obra->lugar_procedencia_actual                 =   $row["lugar_procedencia_actual"];
            $obra->año                                      =   $row["ano"] ? "01/01/".$row["ano"] : NULL;
            $obra->estatus_año                              =   $row["estatus_ano"];
            $obra->estatus_epoca                            =   $row["estatus_epoca"];
            $obra->alto                                     =   $row["alto"] ?? 0;
            $obra->diametro                                 =   $row["diametro"] ?? 0;
            $obra->profundidad                              =   $row["profundidad"] ?? 0;
            $obra->ancho                                    =   $row["ancho"] ?? 0;
            $obra->fecha_ingreso                            =   $row["fecha_ingreso"] ? Carbon::parse(ExcelDate::excelToDateTimeObject($row["fecha_ingreso"])) : NULL;
            $obra->fecha_salida                             =   $row["fecha_salida"] ? Carbon::parse(ExcelDate::excelToDateTimeObject($row["fecha_salida"])) : NULL;
            $obra->modalidad                                =   $row["modalidad"];
            $obra->caracteristicas_descriptivas             =   $row["caracteristicas_descriptivas"];
            $obra->lugar_procedencia_original               =   $row["lugar_procedencia_original"];
            $obra->forma_ingreso                            =   $row["forma_ingreso"];
            $obra->disponible_consulta                      =   $row["consulta_externa"] ?? 0;

            $tags                                           =   implode("|", $obra->toArray());
            $obra->tags                                     =   $tags;

            $obra->save();
            $obra->refresh();

            ##### RESPONSABLES ECRO ####################################################
                $responsablesEcro                           =   explode(",", $row["responsables_ecro"]);
                foreach ($responsablesEcro as $usuario_responsable_id) {
                    if (is_numeric($usuario_responsable_id)) {
                        $responsable                        =   ObrasResponsablesAsignados::where("usuario_id", $usuario_responsable_id)
                                                                                            ->where("obra_id", $obra->id)
                                                                                            ->first();

                        if (is_null($responsable)) {
                            $responsable                    =   new ObrasResponsablesAsignados;
                            $responsable->usuario_id        =   $usuario_responsable_id;
                            $responsable->obra_id           =   $obra->id;
                            $responsable->save();
                        }
                    }
                }

                // Eliminamos todos los responsables asignados que no esten en el array del explode
                $eliminados                                 =   ObrasResponsablesAsignados::where('obra_id', $obra->id)
                                                                                            ->whereNotIn('usuario_id', $responsablesEcro)
                                                                                            ->delete();
            ############################################################################

            ##### TEMPORADAS TRABAJO ####################################################
                $temporadas                                                                 =   explode(",", $row["temporadas_trabajo"]);
                if ($obra->proyecto) {
                    foreach ($temporadas as $temporada_trabajo) {
                        if (is_numeric($temporada_trabajo)) {
                            // Buscamos la temporada para el proyecto, si no existe no hacemos nada
                            $temporada                                                      =   ProyectosTemporadasTrabajo::where('proyecto_id', $obra->proyecto_id)
                                                                                                                        ->where('año', $temporada_trabajo)
                                                                                                                        ->first();
                            if (!is_null($temporada)) {
                                $temporadaAsignada                                          =   ObrasTemporadasTrabajoAsignadas::where("proyecto_temporada_trabajo_id", $temporada->id)
                                                                                                                                ->where("obra_id", $obra->id)
                                                                                                                                ->first();
    
                                if (is_null($temporadaAsignada)) {
                                    $temporadaAsignada                                      =   new ObrasTemporadasTrabajoAsignadas;
                                    $temporadaAsignada->proyecto_temporada_trabajo_id       =   $temporada->id;
                                    $temporadaAsignada->obra_id                             =   $obra->id;
                                    $temporadaAsignada->save();
                                }
                            }
                            
                        }
                    }
    
                    // Eliminamos todos los responsables asignados que no esten en el array del explode
                    // $eliminados                             =   ObrasResponsablesAsignados::where('obra_id', $obra->id)
                    //                                                                             ->whereNotIn('usuario_id', $responsablesEcro)
                    //                                                                             ->delete();
                }
                
            ############################################################################
        } catch (\Exception $e) {
            // dd($e, $row);
            throw $e;
        }
        
    }

    private static function castFecha($fecha){
        if (is_null($fecha)) {
            return NULL;
        } else{
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha);
        }
    }
}
