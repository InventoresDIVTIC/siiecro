<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasAnalisisARealizarInformacionDelEquipo;

class ObrasAnalisisARealizarInformacionDelEquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada');
        $this->middleware('VerificarPermiso:eliminar_catalogos',    ["only" =>  ["eliminar", "destroy"]]);
    }
    
    public function index(){
    	$titulo 		= 	"Áreas";
    	
    	return view("dashboard.obras.informacion-del-equipo.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
    	$registros 		= 	ObrasAnalisisARealizarInformacionDelEquipo::all();

    	return DataTables::of($registros)
    					->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
                            $eliminar   	=   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';

                            return $editar.$eliminar;
    					})
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function create(Request $request){
        $registro   =   new ObrasAnalisisARealizarInformacionDelEquipo;
        return view('dashboard.obras.informacion-del-equipo.agregar', ["registro" => $registro]);
    }

    public function store(Request $request){
        if($request->ajax()){
            return BD::crear('ObrasAnalisisARealizarInformacionDelEquipo', $request);
        }
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro   =   ObrasAnalisisARealizarInformacionDelEquipo::findOrFail($id);
        return view('dashboard.obras.informacion-del-equipo.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            $data   =  $request->all();
            return BD::actualiza($id, "ObrasAnalisisARealizarInformacionDelEquipo", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   ObrasAnalisisARealizarInformacionDelEquipo::findOrFail($id);
        return view('dashboard.obras.informacion-del-equipo.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "ObrasAnalisisARealizarInformacionDelEquipo");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
