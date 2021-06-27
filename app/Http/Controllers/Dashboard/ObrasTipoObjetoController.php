<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasTipoObjeto;
use App\ObrasTipoObjetoTesauros;

class ObrasTipoObjetoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada|captura_de_catalogos_basica');
        $this->middleware('VerificarPermiso:eliminar_catalogos',    ["only" =>  ["eliminar", "destroy"]]);
    }
    
    public function index(){
        $titulo         =   "Obras Tipo Objeto";
        
        return view("dashboard.obras.tipo-objeto.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   ObrasTipoObjeto::all();

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';
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
        $registro   =   new ObrasTipoObjeto;
        return view('dashboard.obras.tipo-objeto.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoObjeto', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasTipoObjeto::findOrFail($id);
        return view('dashboard.obras.tipo-objeto.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoObjeto", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasTipoObjeto::findOrFail($id);
        return view('dashboard.obras.tipo-objeto.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoObjeto");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### TIPO OBJETO TÉRMINOS RELACIONADOS TESAUROS #####################################################
    public function cargarTerminosRelacionados($id)
    {
        $registros = ObrasTipoObjetoTesauros::where('tipo_objeto_id', '=', $id)->get();

        return DataTables::of($registros)
                            ->addColumn('acciones', function($registro){
                                $editar         = '<i onclick="editarTerminoRelacionado('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar interpretación particular '.$registro->nombre.'"></i>';
                                $eliminar       = '<i onclick="eliminarTerminoRelacionado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar interpretación particular '.$registro->nombre.'"></i>';
                                
                                return $editar.$eliminar;
                            })
                            ->rawColumns(['acciones'])
                            ->make('true');
    }

    public function crearTerminosRelacionados()
    {
        $registro   =   new ObrasTipoObjetoTesauros;
        return view('dashboard.obras.tipo-objeto.tesauros.agregar-termino', ["registro" => $registro]);
    }

    public function guardarTerminosRelacionados(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoObjetoTesauros', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function editarTerminosRelacionados(Request $request, $id)
    {
        $registro   = ObrasTipoObjetoTesauros::findOrFail($id);
        return view('dashboard.obras.tipo-objeto.tesauros.agregar-termino', ["registro" => $registro]);
    }

    public function actualizarTerminosRelacionados(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoObjetoTesauros", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarTerminosRelacionados(Request $request, $id)
    {
        $registro   =   ObrasTipoObjetoTesauros::findOrFail($id);
        return view('dashboard.obras.tipo-objeto.tesauros.eliminar-termino', ["registro" => $registro]);
    }

    public function destruirTerminosRelacionados(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoObjetoTesauros");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #######################################################################################################

}
