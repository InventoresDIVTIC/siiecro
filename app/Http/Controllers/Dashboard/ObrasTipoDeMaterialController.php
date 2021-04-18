<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;

use App\ObrasTipoMaterial;
use App\ObrasTipoMaterialInterpretacionParticular;
use App\ObrasTipoMaterialInterCruzada;

use App\ObrasTipoMaterialInformacionPorDefinir;
use App\ObrasTipoMaterialInfoCruzada;

class ObrasTipoDeMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada|captura_de_catalogos_basica');
        $this->middleware('VerificarPermiso:eliminar_catalogos',    ["only" =>  ["eliminar", "destroy"]]);
    }
    
    public function index(){
        $titulo         =   "Obras Tipo de Material";
        
        return view("dashboard.obras.tipo-de-material.index", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request)
    {
        $registros      =   ObrasTipoMaterial::all();

        return DataTables::of($registros)
                        ->addColumn('acciones', function($registro){
                            $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Ver y/o Editar"></i>';
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
        $registro   =   new ObrasTipoMaterial;
        return view('dashboard.obras.tipo-de-material.agregar', ["registro" => $registro]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoMaterial', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id)
    {
        $registro   =   ObrasTipoMaterial::findOrFail($id);
        return view('dashboard.obras.tipo-de-material.agregar', ["registro" => $registro]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoMaterial", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasTipoMaterial::findOrFail($id);
        return view('dashboard.obras.tipo-de-material.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoMaterial");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### TIPO MATERIAL INTERPRETACIÓN PARTICULAR #####################################################
    public function cargarInterpretacionesCruzadas($id)
    {
        $registros = ObrasTipoMaterialInterCruzada::selectRaw('
                                                                obras__tipo_material__inter_cruzada.id,
                                                                ip_cruzada.nombre
                                                            ')
                                                    ->join('obras__tipo_material__interpretacion_particular as ip_cruzada', 'ip_cruzada.id', '=', 'obras__tipo_material__inter_cruzada.interpretacion_particular_cruzada_id')
                                                    ->where('obras__tipo_material__inter_cruzada.tipo_material_cruzada_iter_id', '=', $id)
                                                    ->get();

        return DataTables::of($registros)
                            ->addColumn('acciones', function($registro){
                                $editar         = '<i onclick="editarInterpretacionParticularCruzada('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar interpretación particular '.$registro->nombre.'"></i>';
                                $eliminar       = '<i onclick="eliminarInterpretacionParticularCruzada('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar interpretación particular '.$registro->nombre.'"></i>';
                                
                                return $editar.$eliminar;
                            })
                            ->rawColumns(['acciones'])
                            ->make('true');
    }

    public function crearInterpretacionCruzada($id)
    {
        $registro                           = new ObrasTipoMaterialInterCruzada;
        $tipo_interpretaciones_existentes   = ObrasTipoMaterialInterCruzada::where('tipo_material_cruzada_iter_id', '=', $id)->get();
        $existentes                         = [];
        
        foreach ($tipo_interpretaciones_existentes as $interpretaciones) {
            $existentes[] = $interpretaciones->interpretacion_particular_cruzada_id;
        }

        $interpretaciones   = ObrasTipoMaterialInterpretacionParticular::whereNotIn('id', $existentes)->get();

        return view('dashboard.obras.tipo-de-material.interpretacion-cruzada.agregar-interpretacion-cruzada', ["registro" => $registro, 'interpretaciones' => $interpretaciones]);
    }

    public function guardarInterpretacionCruzada(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoMaterialInterCruzada', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function editarInterpretacionCruzada(Request $request, $id)
    {
        $registro           = ObrasTipoMaterialInterCruzada::findOrFail($id);
        $interpretaciones   = ObrasTipoMaterialInterpretacionParticular::all();

        return view('dashboard.obras.tipo-de-material.interpretacion-cruzada.agregar-interpretacion-cruzada', ["registro" => $registro, 'interpretaciones' => $interpretaciones]);
    }

    public function actualizarInterpretacionCruzada(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoMaterialInterCruzada", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarInterpretacionCruzada(Request $request, $id)
    {
        $registro   = ObrasTipoMaterialInterCruzada::findOrFail($id);
        return view('dashboard.obras.tipo-de-material.interpretacion-cruzada.eliminar-interpretacion-cruzada', ["registro" => $registro]);
    }

    public function destruirInterpretacionCruzada(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoMaterialInterCruzada");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #######################################################################################################
   
    ##### TIPO MATERIAL INFORMACIÓN POR DEFINIR #####################################################
    public function cargarInformacionesCruzadas($id)
    {
        $registros = ObrasTipoMaterialInfoCruzada::selectRaw('
                                                                obras__tipo_material__info_cruzada.id,
                                                                ifpd_cruzada.nombre
                                                            ')
                                                    ->join('obras__tipo_material__informacion_por_definir as ifpd_cruzada', 'ifpd_cruzada.id', '=', 'obras__tipo_material__info_cruzada.informacion_por_definir_cruzada_id')
                                                    ->where('obras__tipo_material__info_cruzada.tipo_material_cruzada_info_id', '=', $id)
                                                    ->get();

        return DataTables::of($registros)
                            ->addColumn('acciones', function($registro){
                                $editar         = '<i onclick="editarInformacionPorDefinirCruzada('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar informacion por definir '.$registro->nombre.'"></i>';
                                $eliminar       = '<i onclick="eliminarInformacionPorDefinirCruzada('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar informacion por definir '.$registro->nombre.'"></i>';
                                
                                return $editar.$eliminar;
                            })
                            ->rawColumns(['acciones'])
                            ->make('true');
    }

    public function crearInformacionCruzada($id)
    {
        $registro                           = new ObrasTipoMaterialInfoCruzada;
        $tipo_informaciones_existentes      = ObrasTipoMaterialInfoCruzada::where('tipo_material_cruzada_info_id', '=', $id)->get();
        $existentes                         = [];
        
        foreach ($tipo_informaciones_existentes as $informaciones) {
            $existentes[] = $informaciones->informacion_por_definir_cruzada_id;
        }

        $informaciones   = ObrasTipoMaterialInformacionPorDefinir::whereNotIn('id', $existentes)->get();

        return view('dashboard.obras.tipo-de-material.informacion-cruzada.agregar-informacion-cruzada', ["registro" => $registro, 'informaciones' => $informaciones]);
    }

    public function guardarInformacionCruzada(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasTipoMaterialInfoCruzada', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function editarInformacionCruzada(Request $request, $id)
    {
        $registro        = ObrasTipoMaterialInfoCruzada::findOrFail($id);
        $informaciones   = ObrasTipoMaterialInformacionPorDefinir::all();

        return view('dashboard.obras.tipo-de-material.informacion-cruzada.agregar-informacion-cruzada', ["registro" => $registro, 'informaciones' => $informaciones]);
    }

    public function actualizarInformacionCruzada(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();
            return BD::actualiza($id, "ObrasTipoMaterialInfoCruzada", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarInformacionCruzada(Request $request, $id)
    {
        $registro   = ObrasTipoMaterialInfoCruzada::findOrFail($id);
        return view('dashboard.obras.tipo-de-material.informacion-cruzada.eliminar-informacion-cruzada', ["registro" => $registro]);
    }

    public function destruirInformacionCruzada(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasTipoMaterialInfoCruzada");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #######################################################################################################
}
