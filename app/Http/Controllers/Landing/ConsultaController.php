<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use App\Obras;
use App\Areas;
use App\User;
use App\Proyectos;
use App\ProyectosTemporadasTrabajo;
use App\ObrasUsuariosAsignados;
use App\ObrasEpoca;
use App\ObrasTemporalidad;
use App\ObrasTipoBienCultural;
use App\ObrasTipoMaterial;
use App\ObrasTipoMaterialInterpretacionParticular;

class ConsultaController extends Controller
{
	public function index(){
    	return view('landing.consulta.index');
    }

    public function busqueda(Request $request){
    	if ($request->ajax()) {
			$filtros                     = $request->input('filtros');
			// FILTRO DE OBRAS PAGINADAS PARA MOSTRAR EL PAGINADO, EL PARÁMETRO QUE HACE LA DIFERENCIA ES EL BOOLEN FINAL
			$obras                       = Obras::consulta($request->input("busqueda"), $request->input("tipo"), $filtros, false);
			// OBTIENE TODAS LAS OBRAS SIN PAGINAR PARA SER USADO EN EL LLENADO DE LOS SELECT DE LOS FILTROS ADMINISTRATIVOS, 
			// EL PARÁMETRO QUE HACE LA DIFERENCIA ES EL BOOLEN FINAL
			$obras_filtradas_sin_paginar = Obras::consulta($request->input("busqueda"), $request->input("tipo"), $filtros, true);
			
			// FILTROS ADMINISTRATIVOS 
			$ids_obras_registro        = array();
			$ids_areas                 = array();
			$ids_proyectos             = array();
			$ids_usuarios_responsables = array();
			$ids_profesores            = array();
			$ids_personas_analizan     = array();
// dd($obras);
            foreach ($obras_filtradas_sin_paginar as $obra) {
            	// dd($obra);

           		if ( ! in_array($obra->id, $ids_obras_registro, true)) {
					$ids_obras_registro[] = $obra->id;
				}

           		if ( ! in_array($obra->area_id, $ids_areas, true)) {
					$ids_areas[] = $obra->area_id;
				}

           		if ( ! in_array($obra->proyecto_id, $ids_proyectos, true)) {
					$ids_proyectos[] = $obra->proyecto_id;
				}

           		if ( ! in_array($obra->usuario_id, $ids_usuarios_responsables)) {
					$ids_usuarios_responsables[] = $obra->usuario_id;
				}

           		if ( ! in_array($obra->profesor_responsable_de_analisis_id, $ids_profesores, true)) {
					$ids_profesores[] = $obra->profesor_responsable_de_analisis_id;
				}

           		if ( ! in_array($obra->persona_realiza_analisis_id, $ids_personas_analizan, true)) {
					$ids_personas_analizan[] = $obra->persona_realiza_analisis_id;
				}
            }
// dd($ids_usuarios_responsables);

			$obras_num_registro         = Obras::whereIn('id', $ids_obras_registro)->get();
			$areas                      = Areas::whereIn('id', $ids_areas)->get();
			// PENDIENTE DE RESPONSABLE
			$responsables               = User::where('es_responsable_ecro', 'si')->whereIn('id', $ids_usuarios_responsables)->get();
			$proyectos                  = Proyectos::whereIn('id', $ids_proyectos)->get();
			$temporadas                 = [];
			$profes_responsables        = User::whereIn('users.id', $ids_profesores)->get();
			$personas_realizan_analisis = User::whereIn('users.id', $ids_personas_analizan)->get();
            

            // $años 				= Obras::selectRaw('SUBSTRING(obras.año, 1, 4) as año')->whereNotNull('obras.año')->get();
            // filtros generales
			$ids                    = array();
			$ids_epocas             = array();
			$ids_temporalidades     = array();
			$ids_tipo_bien_cultural = array();
			$ids_tipo_material      = array();

            foreach ($obras_filtradas_sin_paginar as $obra) {
           		$ids[] = $obra->id;

           		if ( ! in_array($obra->epoca_id, $ids_epocas, true)) {
					$ids_epocas[] = $obra->epoca_id;
				}

           		if ( ! in_array($obra->temporalidad_id, $ids_temporalidades, true)) {
					$ids_temporalidades[] = $obra->temporalidad_id;
				}

           		if ( ! in_array($obra->tipo_bien_cultural_id, $ids_tipo_bien_cultural, true)) {
					$ids_tipo_bien_cultural[] = $obra->tipo_bien_cultural_id;
				}

           		if ( ! in_array($obra->tipo_material_id, $ids_tipo_material, true)) {
					$ids_tipo_material[] = $obra->tipo_material_id;
				}
            }

            // dd($ids);

            $anios 							= Obras::selectRaw('DISTINCT SUBSTRING(obras.año, 1,  4) as anio')->whereNotNull('obras.año')->whereIn('obras.id', $ids)->get();
            $epocas 						= ObrasEpoca::whereIn('id', $ids_epocas)->get();
            $temporalidades 				= ObrasTemporalidad::whereIn('id', $ids_temporalidades)->get();
            $autores 						= Obras::selectRaw('DISTINCT obras.autor')->whereNotNull('obras.autor')->whereIn('obras.id', $ids)->get();
            $culturas 						= Obras::selectRaw('DISTINCT obras.cultura')->whereNotNull('obras.cultura')->whereIn('obras.id', $ids)->get();
            $lugares_procedencia_actual 	= Obras::selectRaw('DISTINCT obras.lugar_procedencia_actual')->whereNotNull('obras.lugar_procedencia_actual')->whereIn('obras.id', $ids)->get();
            $lugares_procedencia_original 	= Obras::selectRaw('DISTINCT obras.lugar_procedencia_original')->whereNotNull('obras.lugar_procedencia_original')->whereIn('obras.id', $ids)->get();
            $tipos_bien_cultural 			= ObrasTipoBienCultural::whereIn('id', $ids_tipo_bien_cultural)->get();
            $tipos_material 				= ObrasTipoMaterial::whereIn('id', $ids_tipo_material)->get();

            $interpretaciones_materiales 	= [];
            // dd($autor);

			$visibilidad_proyecto    = ''; 
			$visibilidad_no_proyecto = ''; 

			if (is_array($filtros) ) {
				if($filtros['proyecto'] != '') {
					$temporadas = ProyectosTemporadasTrabajo::where('proyecto_id', $filtros['proyecto'])->get();
					$visibilidad_proyecto    = ''; 
					$visibilidad_no_proyecto = 'hidden'; 
				}

				if($filtros['tipo_material'] != '') {
            		$interpretaciones_materiales = ObrasTipoMaterialInterpretacionParticular::selectRaw('obras__tipo_material__interpretacion_particular.*')
            										->join('obras__tipo_material__inter_cruzada as tipo_material_cruzada', 'tipo_material_cruzada.interpretacion_particular_cruzada_id', '=', 'obras__tipo_material__interpretacion_particular.id')
            										->join('obras__tipo_material', 'obras__tipo_material.id', '=', 'tipo_material_cruzada.tipo_material_cruzada_iter_id')
            										->where('obras__tipo_material.id', $filtros['tipo_material'])
            										->get();
				}

				if ($filtros['no_proyecto'] != '') {
					$visibilidad_proyecto    = 'hidden'; 
					$visibilidad_no_proyecto = ''; 
				}
			}


			switch ($request->input("tipo")) {
				case 'Material':
					$visible = '';
					break;
				
				case 'Técnica analítica':
					$visible = '';
					break;
				
				default:
					$visible = 'hidden';
					break;
			}
			
			// var_dump($filtros);
			// dd($filtros);

            // return $obras;
            // $obras = $obras->paginate(15);
    		return view('landing.consulta.listado', [
				'obras'                        => $obras,
				'obras_all'                    => $obras_num_registro,
				'areas'                        => $areas,
				'responsables'                 => $responsables,
				'proyectos'                    => $proyectos,
				'visibilidad_proyecto'         => $visibilidad_proyecto,
				'visibilidad_no_proyecto'      => $visibilidad_no_proyecto,
				'temporadas'                   => $temporadas,
				'profes_responsables'          => $profes_responsables,
				'personas_realizan_analisis'   => $personas_realizan_analisis,
				'anios'                        => $anios,
				'epocas'                       => $epocas,
				'temporalidades'               => $temporalidades,
				'autores'                      => $autores,
				'culturas'                     => $culturas,
				'lugares_procedencia_actual'   => $lugares_procedencia_actual,
				'lugares_procedencia_original' => $lugares_procedencia_original,
				'tipos_bien_cultural'          => $tipos_bien_cultural,
				'tipos_material'               => $tipos_material,
				'interpretaciones_materiales'  => $interpretaciones_materiales,
				'filtro_visible'               => $visible,
				'filtros'                      => $filtros
    		]);
    	}

    	return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function detalle(Request $request, $seo){
    	$obra 				=	Obras::where("seo", $seo)->first();

    	return view('landing.consulta.detalle', ["titulo" => $obra->nombre, "obra" => $obra]);
    }

    public function obtenerObrasRecomendadas(Request $request, $id_obra){
    	if ($request->ajax() || true) {
			$ruta 					=	\public_path("resources/obras.csv");
			$process 				= 	new Process([env("DIRECTORIO_PYTHON"), public_path()."/scripts/landing/recomienda.py", "$id_obra", $ruta, env("CANTIDAD_OBRAS_RECOMENDAR", 10)]);
			$process->run();

			// executes after the command finishes
			if (!$process->isSuccessful()) {
			    // throw new ProcessFailedException($process);
			    $obras 				=	collect();
			} else{
				// dd($process->getOutput());
				$obras_ids 			=	json_decode($process->getOutput());
				$obras 				=	Obras::whereIn("id", $obras_ids)->get();
			}

			return view('landing.consulta.recomendaciones', ["obras" => $obras]);
    	}

    	abort(404);
    }
}
