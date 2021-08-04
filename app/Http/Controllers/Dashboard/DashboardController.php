<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Obras;
use App\ObrasSolicitudesAnalisis;
use App\ObrasResultadosAnalisis;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

class DashboardController extends Controller
{
    public function __construct(){
 	    $this->middleware('auth');
    }

	public function index(){
        $objTotalesObras    =   Obras::obtenerObjetoTotalesDashboard();
    	return view('dashboard.dashboard.index', ["objTotalesObras" => $objTotalesObras]);
    }

    public function graficasObrasBienesCulturales(Request $request){
    	if ($request->ajax()) {
    		$obras 		=	Obras::selectRaw("
                                                count(obras.id)                                                 as cantidad,
                                                CONCAT(bien_cultural.nombre, ' (', count(obras.id), ')')        as bien_cultural,
                                                bien_cultural.color_hexadecimal                                 as color
    										")
									->join("obras__tipo_bien_cultural as bien_cultural", "bien_cultural.id", "obras.tipo_bien_cultural_id")
									->groupBy('bien_cultural.id')
									->get();


    		$data 		=	$obras->pluck('cantidad')->toArray();
    		$colores 	=	$obras->pluck('color')->toArray();
    		$labels 	= 	$obras->pluck('bien_cultural')->toArray();

    		return json_encode([
    								"datasets" 				=> 	[
    																[
									    								"data" 				=> 	$data,
									    								"backgroundColor" 	=> 	$colores
																	]
																],
									"labels" 				=> 	$labels
    							]);
    	}
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function graficasObrasTiposObjeto(Request $request){
    	if ($request->ajax()) {
    		$obras 		=	Obras::selectRaw("
                                                count(obras.id)                                             as cantidad,
                                                CONCAT(tipo_objeto.nombre, ' (', count(obras.id), ')')      as tipo_objeto,
                                                tipo_objeto.color_hexadecimal                               as color
    										")
									->join("obras__tipo_objeto as tipo_objeto", "tipo_objeto.id", "obras.tipo_objeto_id")
									->groupBy('tipo_objeto.id')
									->get();


    		$data 		=	$obras->pluck('cantidad')->toArray();
    		$colores 	=	$obras->pluck('color')->toArray();
    		$labels 	= 	$obras->pluck('tipo_objeto')->toArray();

    		return json_encode([
    								"datasets" 				=> 	[
    																[
									    								"data" 				=> 	$data,
									    								"backgroundColor" 	=> 	$colores
																	]
																],
									"labels" 				=> 	$labels
    							]);
    	}
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function graficasObrasAreas(Request $request){
    	if ($request->ajax()) {
    		$obras 		=	Obras::selectRaw("
                                                count(obras.id)                                 as cantidad,
                                                CONCAT(a.siglas, ' (', count(obras.id), ')')    as area,
                                                a.color_hexadecimal                             as color
    										")
									->join("areas as a", "a.id", "obras.area_id")
									->groupBy('a.id')
									->get();


    		$data 		=	$obras->pluck('cantidad')->toArray();
    		$colores 	=	$obras->pluck('color')->toArray();
    		$labels 	= 	$obras->pluck('area')->toArray();

    		return json_encode([
    								"datasets" 				=> 	[
    																[
									    								"data" 				=> 	$data,
									    								"backgroundColor" 	=> 	$colores
																	]
																],
									"labels" 				=> 	$labels
    							]);
    	}
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function tablaObras(Request $request){
        if ($request->ajax()) {
            $busqueda   =   $request->input("search")["value"];
            $registros  =   Obras::obtenerObrasDashboard();

            return DataTables::of($registros)
                        ->addColumn('folio', function($registro){
                            return $registro->folio;
                        })
                        ->addColumn('acciones', function($registro){
                            return '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->id).'"><i class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Ver"></i></a>';
                        })
                        ->filter(function($query) use($busqueda){
                            if ($busqueda != "") {
                                $query->where(function($subquery) use($busqueda){
                                    $subquery->whereRaw("
                                                            CONCAT(
                                                                LPAD(obras.id, 4, '0'),
                                                                '-',
                                                                IFNULL(
                                                                    DATE_FORMAT(obras.fecha_ingreso, '%y'),
                                                                    '00'
                                                                ),
                                                                '/',
                                                                obras.forma_ingreso,
                                                                '-',
                                                                IFNULL(
                                                                    obras.modalidad,
                                                                    ''
                                                                ),
                                                                IFNULL(
                                                                    a.siglas,
                                                                    ''
                                                                )
                                                            ) = '".$busqueda."'
                                                        ")
                                            ->orWhere("obras.id", $busqueda)
                                            ->orWhere("obras.nombre", 'like', '%'.$busqueda.'%')
                                            ->orWhere("a.nombre", 'like', '%'.$busqueda.'%');
                                });
                            }
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function tablaSolicitudesAnalisis(Request $request){
        if ($request->ajax()) {
            $busqueda   =   $request->input("search")["value"];
            $registros  =   ObrasSolicitudesAnalisis::obtenerSolicitudesDashboard();

            return DataTables::of($registros)
                        ->addColumn('obra', function($registro){
                            return $registro->obra->folio;
                        })
                        ->editColumn('fecha_intervencion', function($registro){
                            return $registro->fecha_intervencion->format("Y-m-d");
                        })
                        ->addColumn('temporada', function($registro){
                            $temporada  =   $registro->obra_temporada_trabajo->temporada_trabajo;
                            return "[".$temporada->año."] ".$temporada->numero_temporada;
                        })
                        ->addColumn('acciones', function($registro){
                            return '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->obra_id).'?solicitud-analisis='.$registro->id.'"><i class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Ver"></i></a>';
                        })
                        ->filter(function($query) use($busqueda){
                            if ($busqueda != "") {
                                $query->where(function($subquery) use($busqueda){
                                    $subquery->whereRaw("
                                                            CONCAT(
                                                                LPAD(obras.id, 4, '0'),
                                                                '-',
                                                                IFNULL(
                                                                    DATE_FORMAT(obras.fecha_ingreso, '%y'),
                                                                    '00'
                                                                ),
                                                                '/',
                                                                obras.forma_ingreso,
                                                                '-',
                                                                IFNULL(
                                                                    obras.modalidad,
                                                                    ''
                                                                ),
                                                                IFNULL(
                                                                    a.siglas,
                                                                    ''
                                                                )
                                                            ) = '".$busqueda."'
                                                        ")
                                            ->orWhere("obras.id", $busqueda)
                                            ->orWhere("obras.nombre", 'like', '%'.$busqueda.'%')
                                            ->orWhere("a.nombre", 'like', '%'.$busqueda.'%');
                                });
                            }
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function tablaResultadosAnalisis(Request $request){
        if ($request->ajax()) {
            $busqueda   =   $request->input("search")["value"];
            $registros  =   ObrasResultadosAnalisis::obtenerResultadosDashboard();

            return DataTables::of($registros)
                        ->addColumn('obra', function($registro){
                            return $registro->solicitud_analisis_muestra->solicitud_analisis->obra->folio;
                        })
                        ->editColumn('fecha_analisis', function($registro){
                            return $registro->fecha_analisis->format("Y-m-d");
                        })
                        ->addColumn('acciones', function($registro){
                            return '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->solicitud_analisis_muestra->solicitud_analisis->obra_id).'?resultado-analisis='.$registro->id.'"><i class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Ver"></i></a>';
                        })
                        ->filter(function($query) use($busqueda){
                            if ($busqueda != "") {
                                $query->where(function($subquery) use($busqueda){
                                    $subquery->whereRaw("
                                                            CONCAT(
                                                                LPAD(obras.id, 4, '0'),
                                                                '-',
                                                                IFNULL(
                                                                    DATE_FORMAT(obras.fecha_ingreso, '%y'),
                                                                    '00'
                                                                ),
                                                                '/',
                                                                obras.forma_ingreso,
                                                                '-',
                                                                IFNULL(
                                                                    obras.modalidad,
                                                                    ''
                                                                ),
                                                                IFNULL(
                                                                    a.siglas,
                                                                    ''
                                                                )
                                                            ) = '".$busqueda."'
                                                        ")
                                            ->orWhere("obras.id", $busqueda)
                                            ->orWhere("obras.nombre",       'like',     '%'.$busqueda.'%')
                                            ->orWhere("user_asesor.name",   'like',     '%'.$busqueda.'%')
                                            ->orWhere("user_persona.name",  'like',     '%'.$busqueda.'%')
                                            ->orWhere("a.nombre",           'like',     '%'.$busqueda.'%');
                                });
                            }
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
