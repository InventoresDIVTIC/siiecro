<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Proyectos;
use App\ProyectosTemporadasTrabajo;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

class ProyectosTemporadasTrabajoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

        $this->middleware('VerificarPermiso:imprimir_oficios',          [
                                                                            "only"  =>  [
                                                                                            "imprimir"
                                                                                        ]
                                                                        ]);
    }

    public function cargarTabla(Request $request, $proyecto_id){
        $registros      =   ProyectosTemporadasTrabajo::where('proyecto_id', $proyecto_id);

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
                            $eliminar       =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                            $imprimir       =   '';

                            if (Auth::user()->rol->imprimir_oficios) {
                                $imprimir   =   '
                                                    <div class="btn-group pull-right">
                                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Imprimir <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a target="_blank" href="'.route("dashboard.temporadas-trabajo.imprimir-entrada", $registro->id).'">Entrada</a></li>
                                                            <li><a target="_blank" href="'.route("dashboard.temporadas-trabajo.imprimir-salida", $registro->id).'">Salida</a></li>
                                                        </ul>
                                                    </div>
                                                ';
                            }

                            return $editar.$eliminar.$imprimir;
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request){
        $registro   =   new ProyectosTemporadasTrabajo;
        return view('dashboard.proyectos.temporadas-trabajo.agregar', ["registro" => $registro]);
    }

    public function store(Request $request){
        if($request->ajax()){
            return BD::crear('ProyectosTemporadasTrabajo', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro   =   ProyectosTemporadasTrabajo::findOrFail($id);
        return view('dashboard.proyectos.temporadas-trabajo.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            $data   		= 	$request->all();
            return BD::actualiza($id, "ProyectosTemporadasTrabajo", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   ProyectosTemporadasTrabajo::findOrFail($id);
        return view('dashboard.proyectos.temporadas-trabajo.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "ProyectosTemporadasTrabajo");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function select2(Request $request){
        if($request->ajax()){
            $proyecto_id        =   $request->input('proyecto_id');

            $temporadas         =   ProyectosTemporadasTrabajo::selectRaw("proyectos__temporadas_trabajo.*")
                                                            ->where('proyecto_id', $proyecto_id)
                                                            ->get();

            $array              =   [];

            $a                  =   [];
            $a["id"]            =   "";
            $a["text"]          =   "";
            array_push($array, $a);

            foreach ($temporadas as $temporada) {
                $a              =   [];
                $a["id"]        =   $temporada->id;
                $a["text"]      =   $temporada->numero_temporada." [".$temporada->año."]";

                array_push($array, $a);
            }

            return json_encode($array);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function imprimirEntrada(Request $request, $temporada_id){
        $registro   =   ProyectosTemporadasTrabajo::findOrFail($temporada_id);
        
        return $registro->generarPdfEntrada()->stream($registro->proyecto->folio."-".$registro->año."-".$registro->numero_temporada.".pdf");
    }

    public function imprimirSalida(Request $request, $temporada_id){
        $registro   =   ProyectosTemporadasTrabajo::findOrFail($temporada_id);
        
        return $registro->generarPdfSalida()->stream($registro->proyecto->folio."-".$registro->año."-".$registro->numero_temporada.".pdf");
    }

    public function seeder(){
        if (Auth::user()->rol->nombre == "Administrador") {
            $temporadas         =   ProyectosTemporadasTrabajo::all();

            echo "[<br>";

            foreach ($temporadas as $temporada) {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;[<br>";

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'id' => ".$temporada->id.",";
                echo "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'proyecto_id' => ".$temporada->proyecto_id.",";
                echo "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'año' => '".$temporada->año."',";
                echo "<br>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'numero_temporada' => '".$temporada->numero_temporada."',";
                echo "<br>";

                echo "&nbsp;&nbsp;&nbsp;&nbsp;],<br>";
            }

            echo "<br>]";
        }
    }
}
