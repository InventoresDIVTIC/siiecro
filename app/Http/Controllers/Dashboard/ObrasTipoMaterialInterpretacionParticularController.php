<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

// Interpretación particular se renombra por interpretación material 
// solo en las etiquetas visibles para el usuario del sistema, ya que 
// realizar el cambio a nivel de estructura del código y base de datos es extenso
use App\ObrasTipoMaterialInterpretacionParticular;
use App\ObrasTipoMaterialInterpretacionParticularTesauros;

class ObrasTipoMaterialInterpretacionParticularController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada|captura_de_catalogos_basica');
        $this->middleware('VerificarPermiso:eliminar_catalogos',    ["only" =>  ["eliminar", "destroy"]]);
    }
    
    public function index(){
        $titulo         =   "Obras Informacion por Definir";
        
        return view("dashboard.obras.interpretacion-particular.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   ObrasTipoMaterialInterpretacionParticular::all();

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
        $registro   =   new ObrasTipoMaterialInterpretacionParticular;
        return view('dashboard.obras.interpretacion-particular.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoMaterialInterpretacionParticular', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasTipoMaterialInterpretacionParticular::findOrFail($id);
        return view('dashboard.obras.interpretacion-particular.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoMaterialInterpretacionParticular", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasTipoMaterialInterpretacionParticular::findOrFail($id);
        return view('dashboard.obras.interpretacion-particular.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoMaterialInterpretacionParticular");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### TÉRMINOS RELACIONADOS TESAUROS #####################################################
    public function cargarTerminosRelacionados($id)
    {
        $registros = ObrasTipoMaterialInterpretacionParticularTesauros::where('tipo_material_interpretacion_particular_id', '=', $id)->get();

        return DataTables::of($registros)
                            ->addColumn('acciones', function($registro){
                                $editar         = '<i onclick="editarTerminoRelacionado('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar término relacionado '.$registro->nombre.'"></i>';
                                $eliminar       = '<i onclick="eliminarTerminoRelacionado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar término relacionado '.$registro->nombre.'"></i>';
                                
                                return $editar.$eliminar;
                            })
                            ->rawColumns(['acciones'])
                            ->make('true');
    }

    public function crearTerminosRelacionados()
    {
        $registro = new ObrasTipoMaterialInterpretacionParticularTesauros;
        return view('dashboard.obras.interpretacion-particular.tesauros.agregar-termino', ["registro" => $registro]);
    }

    public function guardarTerminosRelacionados(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoMaterialInterpretacionParticularTesauros', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function editarTerminosRelacionados(Request $request, $id)
    {
        $registro = ObrasTipoMaterialInterpretacionParticularTesauros::findOrFail($id);
        return view('dashboard.obras.interpretacion-particular.tesauros.agregar-termino', ["registro" => $registro]);
    }

    public function actualizarTerminosRelacionados(Request $request, $id)
    {
        if($request->ajax()){
            $data = $request->all();
            return BD::actualiza($id, "ObrasTipoMaterialInterpretacionParticularTesauros", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarTerminosRelacionados(Request $request, $id)
    {
        $registro = ObrasTipoMaterialInterpretacionParticularTesauros::findOrFail($id);
        return view('dashboard.obras.interpretacion-particular.tesauros.eliminar-termino', ["registro" => $registro]);
    }

    public function destruirTerminosRelacionados(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoMaterialInterpretacionParticularTesauros");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #######################################################################################################

}
