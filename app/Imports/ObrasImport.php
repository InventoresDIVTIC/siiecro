<?php

namespace App\Imports;

use App\Areas;
use App\Obras;
use App\ObrasTemporalidad;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
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
        // Si recibimos una temporalidad id como numero entonces es el id
        // si no entonces tenemos que crearla
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

        try {
            $obra                                   =   Obras::find($row["id"]);

            if (is_null($obra)) {
                $obra                               =   new Obras;
                $obra->usuario_solicito_id          =   Auth::id();
                $obra->usuario_aprobo_id            =   Auth::id();
                $obra->usuario_recibio_id           =   Auth::id();
                $obra->numero_inventario            =   $row["numero_inventario"];
                $obra->fecha_aprobacion             =   Carbon::now();
            }

            
            $obra->tipo_objeto_id                   =   $row["tipo_objeto_id"];
            $obra->tipo_bien_cultural_id            =   $row["tipo_bien_cultural_id"];
            $obra->epoca_id                         =   $row["epoca_id"];
            $obra->temporalidad_id                  =   $temporalidad_id;
            $obra->area_id                          =   $area_id;
            $obra->proyecto_id                      =   $row["proyecto_id"];
            $obra->nombre                           =   $row["nombre"];
            $obra->autor                            =   $row["autor"];
            $obra->cultura                          =   $row["cultura"];
            $obra->lugar_procedencia_actual         =   $row["lugar_procedencia_actual"];
            $obra->año                              =   $row["ano"];
            $obra->estatus_año                      =   $row["estatus_ano"];
            $obra->estatus_epoca                    =   $row["estatus_epoca"];
            $obra->alto                             =   $row["alto"] ?? 0;
            $obra->diametro                         =   $row["diametro"] ?? 0;
            $obra->profundidad                      =   $row["profundidad"] ?? 0;
            $obra->ancho                            =   $row["ancho"] ?? 0;
            $obra->fecha_ingreso                    =   $row["fecha_ingreso"];
            $obra->fecha_salida                     =   $row["fecha_salida"];
            $obra->modalidad                        =   $row["modalidad"];
            $obra->caracteristicas_descriptivas     =   $row["caracteristicas_descriptivas"];
            $obra->lugar_procedencia_original       =   $row["lugar_procedencia_original"];
            $obra->forma_ingreso                    =   $row["forma_ingreso"];
            $obra->disponible_consulta              =   $row["consulta_externa"];

            $tags                                   =   implode("|", $obra->toArray());
            $obra->tags                             =   $tags;

            $obra->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return null;
        }
        
    }
}
