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
			$filtros             = $request->input('filtros');
			$obras               = Obras::consulta($request->input("busqueda"), $request->input("tipo"), $filtros);
			
			$obras_all           = Obras::all();
			$areas               = Areas::all();
			$responsables        = User::where('es_responsable_ecro', 'si')->get();
			$proyectos           = Proyectos::all();
			$temporadas          = [];
			$profes_responsables = User::selectRaw('
											DISTINCT
                                            users.id,
                                            users.name
                                            ')
                                ->join('roles', 'roles.id','=','users.rol_id')
                                ->where('roles.nombre', 'LIKE', '%cientific%')
                                ->get();

	        $personas_realizan_analisis = ObrasUsuariosAsignados::selectRaw(' 
	        											DISTINCT
                                                        users.id,
                                                        users.name
                                                    ')
                                        ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                        ->join('obras__solicitudes_analisis', 'obras__solicitudes_analisis.obra_id', '=', 'obras__usuarios_asignados.obra_id')
                                        ->where('obras__usuarios_asignados.status', '=', 'Activo')
                                        ->get();
            
            // $años 				= Obras::selectRaw('SUBSTRING(obras.año, 1, 4) as año')->whereNotNull('obras.año')->get();
            $anios 							= Obras::selectRaw('DISTINCT SUBSTRING(obras.año, 1,  4) as anio')->whereNotNull('obras.año')->get();
            $epocas 						= ObrasEpoca::all();
            $temporalidades 				= ObrasTemporalidad::all();
            $autores 						= Obras::selectRaw('DISTINCT obras.autor')->whereNotNull('obras.autor')->get();
            $culturas 						= Obras::selectRaw('DISTINCT obras.cultura')->whereNotNull('obras.cultura')->get();
            $lugares_procedencia_actual 	= Obras::selectRaw('DISTINCT obras.lugar_procedencia_actual')->whereNotNull('obras.lugar_procedencia_actual')->get();
            $lugares_procedencia_original 	= Obras::selectRaw('DISTINCT obras.lugar_procedencia_original')->whereNotNull('obras.lugar_procedencia_original')->get();
            $tipos_bien_cultural 			= ObrasTipoBienCultural::all();
            $tipos_material 				= ObrasTipoMaterial::all();

            $interpretaciones_materiales 	= [];
            // dd($autor);

			if (is_array($filtros) ) {
				if($filtros['proyecto'] != '') {
					$temporadas = ProyectosTemporadasTrabajo::where('proyecto_id', $filtros['proyecto'])->get();
				}

				if($filtros['tipo_material'] != '') {
            		$interpretaciones_materiales = ObrasTipoMaterialInterpretacionParticular::selectRaw('obras__tipo_material__interpretacion_particular.*')
            										->join('obras__tipo_material__inter_cruzada as tipo_material_cruzada', 'tipo_material_cruzada.interpretacion_particular_cruzada_id', '=', 'obras__tipo_material__interpretacion_particular.id')
            										->join('obras__tipo_material', 'obras__tipo_material.id', '=', 'tipo_material_cruzada.tipo_material_cruzada_iter_id')
            										->where('obras__tipo_material.id', $filtros['tipo_material'])
            										->get();
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
    		return view('landing.consulta.listado', [
				'obras'                      	=> $obras,
				'obras_all'                  	=> $obras_all,
				'areas'                      	=> $areas,
				'responsables'               	=> $responsables,
				'proyectos'                  	=> $proyectos,
				'temporadas'                 	=> $temporadas,
				'profes_responsables'        	=> $profes_responsables,
				'personas_realizan_analisis' 	=> $personas_realizan_analisis,
				'anios' 					 	=> $anios,
				'epocas' 					 	=> $epocas,
				'temporalidades' 			 	=> $temporalidades,
				'autores' 			 		 	=> $autores,
				'culturas' 			 		 	=> $culturas,
				'lugares_procedencia_actual' 	=> $lugares_procedencia_actual,
				'lugares_procedencia_original' 	=> $lugares_procedencia_original,
				'tipos_bien_cultural' 			=> $tipos_bien_cultural,
				'tipos_material' 				=> $tipos_material,
				'interpretaciones_materiales' 	=> $interpretaciones_materiales,
				'filtro_visible'             	=> $visible,
				'filtros'                   	=> $filtros
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
