<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ObrasImport;

use DataTables;
use BD;
use DB;
use Response;
use Hash;
use Auth;
use Archivos;

use App\Areas;
use App\Obras;
use App\ObrasEpoca;
use App\ObrasResponsablesAsignados;
use App\ObrasTemporalidad;
use App\ObrasTemporadasTrabajoAsignadas;
use App\ObrasTipoBienCultural;
use App\ObrasTipoObjeto;
use App\User;
use App\ObrasImagenesPrincipales;

class ObrasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:administrar_solicitudes_obras',     [
                                                                                    "only" => [
                                                                                                    "modalAprobar", 
                                                                                                    "aprobar", 
                                                                                                    "modalRechazar", 
                                                                                                    "rechazar"
                                                                                                ]
                                                                                ]);
        $this->middleware('VerificarPermiso:eliminar_solicitudes_obras',    [
                                                                                "only"  =>  [
                                                                                                "eliminar", 
                                                                                                "destroy"
                                                                                            ]
                                                                            ]);
        $this->middleware('VerificarPermiso:imprimir_condicionado',         [
                                                                                "only"  =>  [
                                                                                                "imprimir"
                                                                                            ]
                                                                            ]);
        $this->middleware('VerificarPermiso:imprimir_oficios',              [
                                                                                "only"  =>  [
                                                                                                "imprimirOficio"
                                                                                            ]
                                                                            ]);
    }
    
    public function index(){
    	$titulo 		= 	"Obras";
    	
    	return view("dashboard.obras.index", ["titulo" => $titulo]);
    }

    public function solicitudesIntervencion(){
        $titulo         =   "Solicitudes de intervención";
        
        return view("dashboard.obras.solicitudes-intervencion", ["titulo" => $titulo]);
    }

    public function cargarTabla(Request $request){
        $busqueda       =   $request->input("search")["value"];
    	$registros 		= 	Obras::selectRaw("
                                                obras.*,
                                                obc.nombre  as tipo_bien_cultural,
                                                oe.nombre   as epoca,
                                                ot.nombre   as temporalidad,
                                                oto.nombre  as tipo_objeto,
                                                a.nombre    as nombre_area
                                            ")
                                    ->join('obras__tipo_bien_cultural as obc',  'obc.id',   'obras.tipo_bien_cultural_id')
                                    ->join('obras__tipo_objeto as oto',         'oto.id',   'obras.tipo_objeto_id')
                                    ->leftJoin('obras__temporalidad as ot',     'ot.id',    'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe',            'oe.id',    'obras.epoca_id')
                                    ->leftJoin('areas as a',                    'a.id',     'obras.area_id')
                                    ->whereNotNull('fecha_aprobacion')
                                    ->groupBy('obras.id');

        // Verifico permiso
        if(!Auth::user()->rol->acceso_a_lista_solicitudes_obras){

            $registros  =   $registros->leftJoin('obras__usuarios_asignados as oua',        'oua.obra_id',  'obras.id')
                                        ->leftJoin('obras__responsables_asignados as ora',  'ora.obra_id',  'obras.id')
                                        ->where(function($query){
                                            $query->orWhere('obras.area_id', Auth::user()->area_id ?? 0);
                                            $query->orWhere(function($query2){
                                                $query2->where('oua.usuario_id', Auth::id());
                                                $query2->where('oua.status', "Activo");
                                            });
                                            $query->orWhere('ora.usuario_id', Auth::id());
                                        });
        }

    	return DataTables::of($registros)
    					->editColumn('id', function($registro){
    						return $registro->folio;
    					})
                        ->editColumn('año', function($registro){
                            if($registro->año){
                                return Carbon::parse($registro->año)->format('Y');
                            }

                            return NULL;
                        })
    					->addColumn('acciones', function($registro){
                            $editar         =   '<a class="icon-link" href="'.route("dashboard.obras.show", $registro->id).'"><i class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Ver detalle"></i></a>';
                            $eliminar   	=   '';

                            if(Auth::user()->rol->eliminar_registro){
                                $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                            }

                            return $editar.$eliminar;
    					})
                        ->filter(function($query) use($busqueda){
                            if ($busqueda != "") {
                                $query->where(function($subquery) use($busqueda){
                                    $subquery->whereRaw("
                                                            CONCAT(
                                                                LPAD(obras.id, 4, '0'),
                                                                '-',
                                                                IFNULL(
                                                                    DATE_FORMAT(obras.año, '%y'),
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
                                            ->orWhere("a.nombre", 'like', '%'.$busqueda.'%')
                                            ->orWhere("a.siglas", 'like', '%'.$busqueda.'%')
                                            ->orWhere("obc.nombre", 'like', '%'.$busqueda.'%')
                                            ->orWhere("oto.nombre", 'like', '%'.$busqueda.'%')
                                            ->orWhere("oe.nombre", 'like', '%'.$busqueda.'%')
                                            ->orWhere("ot.nombre", 'like', '%'.$busqueda.'%');
                                });
                            }
                        })
                        ->rawColumns(['acciones'])
    					->make('true');
    }

    public function cargarSolicitudesIntervencion(){
        $registros      =   Obras::selectRaw("
                                                obras.*,
                                                obc.nombre as tipo_bien_cultural,
                                                oe.nombre as epoca,
                                                ot.nombre as temporalidad,
                                                oto.nombre as tipo_objeto
                                            ")
                                    ->join('obras__tipo_bien_cultural as obc', 'obc.id', 'obras.tipo_bien_cultural_id')
                                    ->join('obras__tipo_objeto as oto', 'oto.id', 'obras.tipo_objeto_id')
                                    ->leftJoin('obras__temporalidad as ot', 'ot.id', 'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe', 'oe.id', 'obras.epoca_id')
                                    ->whereNull('obras.fecha_aprobacion');

        // Verifico permiso
        if(!Auth::user()->rol->acceso_a_lista_solicitudes_obras){
            $registros  =   $registros->where("obras.usuario_solicito_id", Auth::id());
        }

        return DataTables::of($registros)
                        ->editColumn('nombre', function($registro){
                            return $registro->etiquetaStatus();
                        })
                        ->editColumn('año', function($registro){
                            if($registro->año){
                                return $registro->año->format('Y');
                            }

                            return NULL;
                        })
                        ->addColumn('acciones', function($registro){
                            $eliminar           =   '';
                            $aprobar            =   '';
                            $rechazar           =   '';
                            $editar             =   '';

                            if($registro->fecha_rechazo){
                                if(Auth::user()->rol->eliminar_solicitud_obra){
                                    $eliminar   =   '<i onclick="eliminar('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Eliminar"></i>';
                                }
                            } else{
                                $editar         =   '<i onclick="editar('.$registro->id.')" class="fa fa-pencil fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Editar"></i>';

                                if(Auth::user()->rol->administrar_solicitudes_obras){
                                    $aprobar    =   '<i onclick="aprobar('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Aprobar"></i>';
                                    $rechazar   =   '<i onclick="rechazar('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Rechazar"></i>';
                                }
                            }

                            if(Auth::user()->rol->captura_solicitud_obra){
                                return $editar.$aprobar.$rechazar.$eliminar;
                            } else{
                                return "";
                            }
                        })
                        ->rawColumns(['nombre', 'acciones'])
                        ->make('true');
    }

    public function create(Request $request){
        $registro               =   new Obras;
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        $epocas                 =   ObrasEpoca::all();
        $temporalidades         =   ObrasTemporalidad::all();
        return view('dashboard.obras.agregar', ["registro" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades]);
    }

    public function store(Request $request){
        if($request->ajax()){

            // Si calcular temporalidad es si entonces ponemos null los campos de autor, año y epoca
            // Si no entonces ponemos null los campos de cultura y temporalidad
            if($request->input('calcular-temporalidad') == "si"){
                $request->merge([
                                    "autor"             =>  NULL,
                                    "año"               =>  NULL,
                                    "estatus_año"       =>  NULL,
                                    "epoca"             =>  NULL, 
                                    "estatus_epoca"     =>  NULL
                                ]);
            } else{
                $request->merge([
                                    "cultura"           =>  NULL,
                                    "temporalidad_id"   =>  NULL
                                ]);

                // Si el estatus de la epoca es aproximado no debe de tener año
                if($request->input('estatus_epoca') == "Aproximado"){
                    $request->merge([
                                        "año"           =>  NULL,
                                        "estatus_año"   =>  NULL
                                    ]);
                } else{
                    $request->merge([
                                        "año"           =>  $request->input("año")."-01-01"
                                    ]);
                }
            }

            $request->merge([
                                "usuario_solicito_id"   =>  Auth::id()
                            ]);

            $respuesta = BD::crear('Obras', $request);
            
            // if que guarda las etiquetas si antes se creo la obra correctamente
            if(!$respuesta->getData()->error){
                $id_obra = $respuesta->getData()->id;

                $obra_guardada  = Obras::selectRaw("
                                                obras.nombre,
                                                obras.autor,
                                                obras.cultura,
                                                obras.año,
                                                obras.estatus_año,
                                                obras.estatus_epoca,
                                                obras.lugar_procedencia_actual,
                                                obras.numero_inventario,
                                                obc.nombre as tipo_bien_cultural,
                                                oe.nombre as epoca,
                                                ot.nombre as temporalidad,
                                                oto.nombre as tipo_objeto
                                            ")
                                    ->join('obras__tipo_bien_cultural as obc', 'obc.id', 'obras.tipo_bien_cultural_id')
                                    ->join('obras__tipo_objeto as oto', 'oto.id', 'obras.tipo_objeto_id')
                                    ->leftJoin('obras__temporalidad as ot', 'ot.id', 'obras.temporalidad_id')
                                    ->leftJoin('obras__epoca as oe', 'oe.id', 'obras.epoca_id')
                                    ->whereNull('obras.fecha_aprobacion')
                                    ->where('obras.id', '=', $id_obra)
                                    ->first()
                                    ->toArray();

                // $para_tags = $obra_guardada->toArray();
                $para_tags = implode("|", $obra_guardada);
                // guarda los tags de las obras en su campo determinado para ello
                $obra = Obras::find($id_obra);
                $obra->tags = $para_tags;
                $obra->save();
            }

            return $respuesta;
        }
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function edit(Request $request, $id){
        $registro               =   Obras::findOrFail($id);
        $tiposBienCultural      =   ObrasTipoBienCultural::all();
        $epocas                 =   ObrasEpoca::all();
        $tiposObjeto            =   ObrasTipoObjeto::all();
        $temporalidades         =   ObrasTemporalidad::all();
        return view('dashboard.obras.agregar', ["registro" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){

            // Si calcular temporalidad es si entonces ponemos null los campos de autor, año y epoca
            // Si no entonces ponemos null los campos de cultura y temporalidad
            if($request->input('calcular-temporalidad') == "si"){
                $request->merge([
                                    "autor"             =>  NULL,
                                    "año"               =>  NULL,
                                    "estatus_año"       =>  NULL,
                                    "epoca"             =>  NULL, 
                                    "estatus_epoca"     =>  NULL
                                ]);
            } else{
                $request->merge([
                                    "cultura"           =>  NULL,
                                    "temporalidad_id"   =>  NULL
                                ]);

                // Si el estatus de la epoca es aproximado no debe de tener año
                if($request->input('estatus_epoca') == "Aproximado"){
                    $request->merge([
                                        "año"           =>  NULL,
                                        "estatus_año"   =>  NULL
                                    ]);
                } else{
                    $request->merge([
                                        "año"           =>  $request->input("año")."-01-01"
                                    ]);
                }
            }

            $request->merge([
                                "usuario_solicito_id"   =>  Auth::id()
                            ]);
            $data               =   $request->all();
            $respuesta          =   BD::actualiza($id, "Obras", $data);

            // Si se guardo bien entonces guardamos los responsables ECRO
            if(!$respuesta->getData()->error){
                $obra           =   Obras::find($id);

                // Re asignamos los responsables ECRO a la obra
                ObrasResponsablesAsignados::reAsignarResponsables($id, $request->input('_responsables'));

                // Re asignamos las epocas de trabajo recibidas
                ObrasTemporadasTrabajoAsignadas::reAsignarTemporadas($id, $request->input('_temporadas_trabajo'));

                if($request->file('vista_frontal')){
                    $obra->subirImagenVistaFrontal($request->file('vista_frontal'));
                }

                if($request->file('vista_posterior')){
                    $obra->subirImagenVistaPosterior($request->file('vista_posterior'));
                }

                if($request->file('vista_lateral_izquierda')){
                    $obra->subirImagenVistaLateralIzquierda($request->file('vista_lateral_izquierda'));
                }

                if($request->file('vista_lateral_derecha')){
                    $obra->subirImagenVistaLateralDerecha($request->file('vista_lateral_derecha'));
                }

            }

            return $respuesta;
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }


    public function modalAprobar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.aprobar', ["registro" => $registro]);
    }

    public function aprobar(Request $request, $id){
        if($request->ajax()){
            $obra                       =   Obras::findOrFail($id);

            $obra->fecha_aprobacion     =   Carbon::now();
            $obra->save();

            return Response::json(["mensaje" => "Solicitud aprobada exitosamente.", "id" => $obra->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalRechazar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.rechazar', ["registro" => $registro]);
    }

    public function rechazar(Request $request, $id){
        if($request->ajax()){
            $obra                       =   Obras::findOrFail($id);

            $obra->fecha_rechazo        =   Carbon::now();
            $obra->save();

            return Response::json(["mensaje" => "Solicitud rechazada exitosamente.", "id" => $obra->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalImportar(Request $request){
        return view('dashboard.obras.importar');
    }

    public function importar(Request $request){
        if($request->ajax()){
            DB::beginTransaction();

            try {
                Excel::import(new ObrasImport, request()->file('archivo'));
            } catch (\Exception $e) {
                DB::rollback();
                return Response::json(["mensaje" => $e->getMessage(), "error" => true], 500);
            }

            DB::commit();
            return Response::json(["mensaje" => "Obras importadas correctamente.", "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id){
        $registro   =   Obras::findOrFail($id);
        return view('dashboard.obras.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id){
        if($request->ajax()){
            return BD::elimina($id, "Obras");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function show(Request $request, $id){
        $registro                       =   Obras::buscarObraValidandoPermisos($id);
        if(is_null($registro)){
            abort(404);
        }

        $tiposBienCultural              =   ObrasTipoBienCultural::all();
        $tiposObjeto                    =   ObrasTipoObjeto::all();
        $epocas                         =   ObrasEpoca::all();
        $temporalidades                 =   ObrasTemporalidad::all();
        $areas                          =   Areas::all();
        $usuariosPuedenRecibirObras     =   User::where('puede_recibir_obras', 'si')->get();
        $responsablesEcro               =   User::where('es_responsable_ecro', 'si')->get();
        $titulo                         =   $registro->folio;
        return view('dashboard.obras.detalle.detalle', ["titulo" => $titulo, "obra" => $registro, "tiposBienCultural" => $tiposBienCultural, "tiposObjeto" => $tiposObjeto, "epocas" => $epocas, "temporalidades" => $temporalidades, "areas" => $areas, "usuariosPuedenRecibirObras" => $usuariosPuedenRecibirObras, "responsablesEcro" => $responsablesEcro]);
    }

    public function imprimir(Request $request, $obra_id){
        $registro                       =   Obras::buscarObraValidandoPermisos($obra_id);
        if(is_null($registro)){
            abort(404);
        }
        // return view('pdf.obra', ["obra" => $registro]);
        return $registro->generarPdf()->stream($registro->folio.".pdf");
    }

    public function imprimirOficio(Request $request, $obra_id){
        $registro                       =   Obras::buscarObraValidandoPermisos($obra_id);
        if(is_null($registro)){
            abort(404);
        }

        return $registro->generarPdfOficio()->stream($registro->folio.".pdf");
    }

    ##### IMÁGENES PRINCIPALES ###########################################################################

    public function verImagenesPrincipales(Request $request, $obra_id){
        if($request->ajax()){
            $registro   =   Obras::findOrFail($obra_id);
            return view('dashboard.obras.detalle.imagenes-principales.ver', ["imagenes_principales" => $registro->imagenes_principales]);
        }
        
        return "";
    }

    public function subirImagenPrincipal(Request $request, $obra_id){
        if($request->ajax()){
            DB::beginTransaction();

            // se crea un nuevo registro de imagen principal para darle su nombre por id
            $imagen_principal           = new ObrasImagenesPrincipales;
            $imagen_principal->obra_id  = $obra_id;
            $imagen_principal->save();

            $extension                  = $request->file('file')->extension();
            $nombre_imagen_grande       = $imagen_principal->id."_imagen_grande.".$extension;
            $nombre_imagen_chica        = $imagen_principal->id."_imagen_chica.".$extension;

            // se suben dos tamaños de la misma imagen para utilizarlos en la landing según se necesite
            $resultado_imagen_grande    = Archivos::subirImagen($request->file('file'), $nombre_imagen_grande, "img/obras/imagenes-principales/", 1200);
            $resultado_imagen_chica     = Archivos::subirImagen($request->file('file'), $nombre_imagen_chica, "img/obras/imagenes-principales/", 400);
            
            // Si alguna de las imagenes no se subio eliminamos las dos, debido que no podemos dejar una si y otra no
            if($resultado_imagen_grande != "" || $resultado_imagen_chica != ""){
                // Eliminar imagenes
                Archivos::eliminarArchivo("img/obras/imagenes-principales/".$nombre_imagen_grande);
                Archivos::eliminarArchivo("img/obras/imagenes-principales/".$nombre_imagen_chica);

                DB::rollback();
                return Response::json(["mensaje" => "Error subiendo imagen"], 500);
            } else{
                $imagen_principal->imagen_grande = $nombre_imagen_grande;
                $imagen_principal->imagen_chica  = $nombre_imagen_chica;
                $imagen_principal->save();
                
                DB::commit();
                return Response::json(["mensaje" => "Imagen subida correctamente", "id" => $imagen_principal->id, "error" => false], 200);
            }
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function alertaEliminarImagenPrincipal(Request $request, $imagen_principal_id){
        $imagen     =   ObrasImagenesPrincipales::findOrFail($imagen_principal_id);
        return view('dashboard.obras.detalle.imagenes-principales.eliminar', ["registro" => $imagen]);
    }

    public function eliminarImagenPrincipal(Request $request, $imagen_principal_id){
        if($request->ajax()){
            $registro   =   ObrasImagenesPrincipales::find($imagen_principal_id);
            $response   =   BD::elimina($imagen_principal_id, "ObrasImagenesPrincipales");

            if($response->status() == 200){
                Archivos::eliminarArchivo('img/obras/imagenes-principales/'.$registro->imagen_grande);
                Archivos::eliminarArchivo('img/obras/imagenes-principales/'.$registro->imagen_chica);
            }

            return $response;
        }
        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #########################################################################################################
}
