<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasAnalisisARealizar;
use App\ObrasAnalisisARealizarTecnica;

class ObrasAnalisisARealizarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada|captura_de_catalogos_basica');
        $this->middleware('VerificarPermiso:eliminar_catalogos',    ["only" =>  ["eliminar", "destroy"]]);
    }
    
    public function index(){
        $titulo         =   "Obras Informacion por Definir";
        
        return view("dashboard.obras.analisis-a-realizar.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   ObrasAnalisisARealizar::all();

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Ver tecnicas analíticas"></i>';
                            $eliminar       =   '';

                            if(Auth::user()->rol->eliminar_catalogos){
                                $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                            }

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['acciones'])
                        ->make('true');
    }

    public function create(Request $request)
    {
        $registro   =   new ObrasAnalisisARealizar;
        return view('dashboard.obras.analisis-a-realizar.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasAnalisisARealizar', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasAnalisisARealizar::findOrFail($id);
        return view('dashboard.obras.analisis-a-realizar.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasAnalisisARealizar", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasAnalisisARealizar::findOrFail($id);
        return view('dashboard.obras.analisis-a-realizar.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasAnalisisARealizar");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### TECNICAS ANALÍTICAS DE ANÁLISIS A REALIZAR ######################################################
    public function cargarTecnicas($id)
    {
        $registros = ObrasAnalisisARealizarTecnica::where('analisis_a_realizar_id', '=', $id)->get();

        return DataTables::of($registros)
                            ->addColumn('acciones', function($registro){
                                $editar         = '<i onclick="editarTecnicaAnalitica('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar tecnica '.$registro->nombre.'"></i>';
                                $eliminar       = '<i onclick="eliminarTecnicaAnalitica('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar tecnica '.$registro->nombre.'"></i>';
                                
                                return $editar.$eliminar;
                            })
                            ->rawColumns(['acciones'])
                            ->make('true');
    }

    public function crearTecnica()
    {
        $registro   =   new ObrasAnalisisARealizarTecnica;
        return view('dashboard.obras.analisis-a-realizar.agregar-tecnica', ["registro" => $registro]);
    }

    public function guardarTecnica(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasAnalisisARealizarTecnica', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function editarTecnica(Request $request, $id)
    {
        $registro   =   ObrasAnalisisARealizarTecnica::findOrFail($id);
        return view('dashboard.obras.analisis-a-realizar.agregar-tecnica', ["registro" => $registro]);
    }

    public function actualizarTecnica(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasAnalisisARealizarTecnica", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarTecnica(Request $request, $id)
    {
        $registro   =   ObrasAnalisisARealizarTecnica::findOrFail($id);
        return view('dashboard.obras.analisis-a-realizar.eliminar-tecnica', ["registro" => $registro]);
    }

    public function destruirTecnica(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasAnalisisARealizarTecnica");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #######################################################################################################
}
