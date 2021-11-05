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

			if (is_array($filtros) ) {
				if($filtros['proyecto'] != '') {
					$temporadas = ProyectosTemporadasTrabajo::where('proyecto_id', $filtros['proyecto'])->get();
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
				'obras'                      => $obras,
				'obras_all'                  => $obras_all,
				'areas'                      => $areas,
				'responsables'               => $responsables,
				'proyectos'                  => $proyectos,
				'temporadas'                 => $temporadas,
				'profes_responsables'        => $profes_responsables,
				'personas_realizan_analisis' => $personas_realizan_analisis,
				'filtro_visible'             => $visible,
				'filtros'                    => $filtros
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
