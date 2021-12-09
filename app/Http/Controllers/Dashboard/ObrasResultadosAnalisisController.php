<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use DataTables;
use BD;
use Response;
use Hash;
use Auth;
use Archivos;
use DB;
use Arr;

use App\ObrasSolicitudesAnalisisMuestras;

use App\ObrasResultadosAnalisis;
use App\ObrasResultadosAnalisisEsquemaMuestra;
use App\ObrasResultadosAnalisisEsquemaMicrofotografia;
use App\ObrasResultadosAnalisisInterpretacionesParticulares;

use App\ObrasFormaObtencionMuestra;

use App\ObrasTipoMaterial;
use App\ObrasTipoMaterialInformacionPorDefinir;
use App\ObrasTipoMaterialInfoCruzada;
use App\ObrasTipoMaterialInterpretacionParticular;
use App\ObrasTipoMaterialInterCruzada;

use App\ObrasAnalisisARealizarResultados;
use App\ObrasAnalisisARealizar;
use App\ObrasAnalisisARealizarTecnica;
use App\ObrasAnalisisARealizarMicrofotografia;
use App\ObrasAnalisisARealizarInformacionDelEquipo;

use App\ObrasUsuariosAsignados;
use App\User;


class ObrasResultadosAnalisisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_resultados');
        $this->middleware('VerificarPermiso:administrar_registro_resultados',   [
                                                                                        "only"  =>  [
                                                                                                        "modalAprobarResultadoAnalisis",
                                                                                                        "aprobarResultadoAnalisis",
                                                                                                        "modalRechazarResultadoAnalisis",
                                                                                                        "rechazarResultadoAnalisis",
                                                                                                        "modalEnRevisionResultadoAnalisis",
                                                                                                        "enRevisionResultadoAnalisis"
                                                                                                    ]
                                                                                    ]);

        $this->middleware('VerificarPermiso:eliminar_resultados',               [
                                                                                    "only"  =>  [
                                                                                                    "eliminar",
                                                                                                    "destroy"
                                                                                                ]
                                                                                ]);

        $this->middleware('VerificarPermiso:imprimir',                          [
                                                                                    "only"  =>  [
                                                                                                    "imprimir"
                                                                                                ]
                                                                                ]);
    }

    public function cargarTabla(Request $request, $obra_id)
    {
        $registros      =   ObrasResultadosAnalisis::selectRaw('
                                                                    obras__resultados_analisis.id,
                                                                    obras__resultados_analisis.fecha_analisis,
                                                                    obras__resultados_analisis.estatus,
                                                                    obras__resultados_analisis.motivo_de_rechazo,
                                                                    obras__solicitudes_analisis_tipo_analisis.nombre,
                                                                    obras__solicitudes_analisis_muestras.nomenclatura
                                                                ')
                                                                    // obras__resultados_analisis.descripcion,
                                                    // ->join('users', 'users.id','=', 'obras__solicitudes_analisis.obra_usuario_asignado_id')
                                                    ->join('obras__solicitudes_analisis_muestras', 'obras__solicitudes_analisis_muestras.id','=', 'obras__resultados_analisis.solicitudes_analisis_muestras_id')
                                                    ->join('obras__solicitudes_analisis', 'obras__solicitudes_analisis.id','=', 'obras__solicitudes_analisis_muestras.solicitud_analisis_id')
                                                    ->join('obras__solicitudes_analisis_tipo_analisis', 'obras__solicitudes_analisis_tipo_analisis.id','=', 'obras__solicitudes_analisis_muestras.tipo_analisis_id')
                                                    ->where('obras__solicitudes_analisis.obra_id', '=', $obra_id)
                                                    ->get();

        return DataTables::of($registros)
                        ->editColumn('fecha_analisis', function($registro){
                            $label_estatus  = '';
                            $fecha          = '';

                            switch ($registro->estatus) {
                                case 'En revision':{
                                    $label_estatus = 'badge badge-warning';
                                    break;
                                }
                                case 'Aprobado':{
                                    $label_estatus = 'badge badge-primary';
                                    break;
                                }
                                case 'Rechazado':{
                                    $label_estatus = 'badge badge-danger';
                                    break;
                                }
                            }

                            return $fecha = '<span class="'.$label_estatus.'" mi-tooltip="'.$registro->estatus.'. '.$registro->motivo_de_rechazo.'"><strong>'.$registro->fecha_analisis.'</strong></span>';
                        })
                        ->editColumn('imagen', function($registro){
                            $img    = ObrasResultadosAnalisisEsquemaMuestra::where('resultado_analisis_id',$registro->id)->first();
                            $altura = 40;
                            
                            $imagen = '<p id="index-resultados_'.$registro->id.'"><a href="'.asset('img/predeterminadas/sin_imagen.png').'" data-gallery="#galeria-index-resultados_'.$registro->id.'"><img src="'.asset('img/predeterminadas/sin_imagen.png').'" height="'.$altura.'"></a></p>';
                            
                            if ($img != NULL) {
                                $imagen = '<p id="index-resultados_'.$registro->id.'"><a href="'.asset('img/obras/resultados-analisis-esquema-muestra/'.$img->imagen).'" data-gallery="#galeria-index-resultados_'.$registro->id.'"><img src="'.asset('img/obras/resultados-analisis-esquema-muestra/'.$img->imagen).'" height="'.$altura.'"></a></p>';
                            }
                            
                            return $imagen;
                        })
                        ->addColumn('acciones', function($registro){
                            $editar             =   '';
                            $eliminar           =   '';
                            $aprobar            =   '';
                            $rechazar           =   '';
                            $revision           =   '';
                            $imprimir           =   '';

                            if(Auth::user()->rol->imprimir){
                                $imprimir       =   '<a class="icon-link" href="'.route('dashboard.resultados-analisis.imprimir', $registro->id).'" target="_blank"><i class="fa fa-print fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Imprimir"></i></a>';
                            }

                            if ($registro->estatus == 'Rechazado') {
                                // $editar      =   '<i onclick="editarResultado('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Mostrar resultado de analisis"></i>';
                                
                                if(Auth::user()->rol->eliminar_resultados){
                                    $eliminar   =   '<i onclick="eliminarResultado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar resultado de analisis"></i>';
                                }

                                if(Auth::user()->rol->administrar_registro_resultados){
                                    $revision   =   '<i onclick="ponerEnRevisionResultadoAnalisis('.$registro->id.')" class="fa fa-history fa-lg m-r-sm pointer inline-block disabled" aria-hidden="true" mi-tooltip="Poner en revision resultado de analisis"></i>';
                                }
                            }
                            elseif ($registro->estatus == 'Aprobado') {
                                $editar         =   '<i onclick="editarResultado('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Mostrar resultado de analisis"></i>';

                                if(Auth::user()->rol->eliminar_resultados){
                                    $eliminar   =   '<i onclick="eliminarResultado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar resultado de analisis"></i>';
                                }
                                // $aprobar     =   '<i onclick="aprobarResultadoAnalisis('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block disabled" aria-hidden="true" mi-tooltip="Aprobar resultado de analisis"></i>';

                                if(Auth::user()->rol->administrar_registro_resultados){
                                    $rechazar   =   '<i onclick="rechazarResultadoAnalisis('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Rechazar resultado de analisis"></i>';
                                }
                            }
                            else{
                                $editar         =   '<i onclick="editarResultado('.$registro->id.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Mostrar resultado de analisis"></i>';

                                if(Auth::user()->rol->eliminar_resultados){
                                    $eliminar   =   '<i onclick="eliminarResultado('.$registro->id.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar resultado de analisis"></i>';
                                }

                                if(Auth::user()->rol->administrar_registro_resultados){
                                    $aprobar    =   '<i onclick="aprobarResultadoAnalisis('.$registro->id.')" class="fa fa-check-square-o fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Aprobar resultado de analisis"></i>';
                                    $rechazar   =   '<i onclick="rechazarResultadoAnalisis('.$registro->id.')" class="fa fa-ban fa-lg m-r-sm pointer inline-block" aria-hidden="true" mi-tooltip="Rechazar resultado de analisis"></i>';
                                }
                                // $revision    =   '<i onclick="ponerEnRevisionResultadoAnalisis('.$registro->id.')" class="fa fa-history fa-lg m-r-sm pointer inline-block disabled" aria-hidden="true" mi-tooltip="Poner en revision resultado de analisis"></i>';
                            }

                            return $aprobar.$rechazar.$revision.$imprimir.$editar.$eliminar;
                        })
                        ->rawColumns(['imagen','fecha_analisis','acciones'])
                        ->make('true');
    }

    public function imprimir(Request $request, $resultado_analisis_id){
        $registro                       =   ObrasResultadosAnalisis::findOrFail($resultado_analisis_id);

        return $registro->generarPdf()->stream($registro->solicitud_analisis_muestra->solicitud_analisis->obra->folio."-resultado-analisis-".$registro->id.".pdf");
    }

    public function crear($id, $obra_id)
    {
        // se implementa el envío de la solicitud independiente de la variable registro 
        // ya que en este punto la muestra origen existe pero el resultado de analisis aún no
        $solicitud          = ObrasSolicitudesAnalisisMuestras::selectRaw('
                                                                            obras__solicitudes_analisis_muestras.nomenclatura,
                                                                            obras__solicitudes_analisis_tipo_analisis.nombre
                                                                            ')
                                                                ->join('obras__solicitudes_analisis_tipo_analisis', 'obras__solicitudes_analisis_tipo_analisis.id', '=', 'obras__solicitudes_analisis_muestras.tipo_analisis_id')
                                                                ->where('obras__solicitudes_analisis_muestras.id', '=', $id)
                                                                // ->toSql();
                                                                ->first();

        // Rol 8 es asesor científico..... NOTA: Se deja de buscar por id de rol, por que suelen cambiar los id
        // y se busca ahora por LIKE con la cadena cientific por si llegan a poner cinetifico o cientifica :V
        $asesor_cientifico_responsable  = User::selectRaw('
                                                            users.id,
                                                            users.name
                                                            ')
                                                ->join('roles', 'roles.id','=','users.rol_id')
                                                ->where('roles.nombre', 'LIKE', '%cientific%')
                                                ->get();

        // usuarios asignados a la obra que estén activos
        $persona_realiza_analisis  = ObrasUsuariosAsignados::selectRaw('
                                                                            users.id,
                                                                            users.name
                                                                        ')
                                                            ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                                            ->join('obras__solicitudes_analisis', 'obras__solicitudes_analisis.obra_id', '=', 'obras__usuarios_asignados.obra_id')
                                                            ->where('obras__usuarios_asignados.status', '=', 'Activo')
                                                            ->where('obras__solicitudes_analisis.obra_id', '=', $obra_id)
                                                            ->get();

        $registro           = new ObrasResultadosAnalisis;
        $formas_obtencion   = ObrasFormaObtencionMuestra::all();
        // $tipos_material     = ObrasTipoMaterial::all();

        return view('dashboard.obras.detalle.resultados-analisis.agregar', ["registro" => $registro, 'formas_obtencion' => $formas_obtencion, "solicitud" => $solicitud, 'asesor_cientifico_responsable' => $asesor_cientifico_responsable, 'persona_realiza_analisis' => $persona_realiza_analisis]);
        // return view('dashboard.obras.detalle.resultados-analisis.agregar', ["registro" => $registro, 'formas_obtencion' => $formas_obtencion, 'tipos_material' => $tipos_material]);
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            $request->merge([
                                "usuario_creo_id"   =>  Auth::id()
                            ]);

            return BD::crear('ObrasResultadosAnalisis', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta guardar muestra"], 500);
    }

    public function editar(Request $request, $id, $obra_id)
    {
        $registro                                   = ObrasResultadosAnalisis::findOrFail($id);
        $formas_obtencion                           = ObrasFormaObtencionMuestra::all();
        $tipos_material                             = ObrasTipoMaterial::all();

        // se implementa el envío de la solicitud independiente de la variable registro para mostrar los datos de la muestra origen 
        // ya que en el punto de creación del resultado de análisis, el envío de la variable solicitud 
        // de manera independiente es necesario y no se puede precindir de esta variable 
        $solicitud  = ObrasResultadosAnalisis::selectRaw('
                                                            obras__solicitudes_analisis_muestras.nomenclatura,
                                                            obras__solicitudes_analisis_tipo_analisis.nombre
                                                        ')
                                            ->join('obras__solicitudes_analisis_muestras', 'obras__solicitudes_analisis_muestras.id', '=', 'obras__resultados_analisis.solicitudes_analisis_muestras_id')
                                            ->join('obras__solicitudes_analisis_tipo_analisis', 'obras__solicitudes_analisis_tipo_analisis.id', '=', 'obras__solicitudes_analisis_muestras.tipo_analisis_id')
                                            ->where('obras__resultados_analisis.id', '=', $id)
                                            ->first();

        // Rol 8 es asesor científico..... NOTA: Se deja de buscar por id de rol, por que suelen cambiar los id
        // y se busca ahora por LIKE con la cadena cientific por si llegan a poner cinetifico o cientifica :V
        $asesor_cientifico_responsable  = User::selectRaw('
                                                            users.id,
                                                            users.name
                                                            ')
                                                ->join('roles', 'roles.id','=','users.rol_id')
                                                ->where('roles.nombre', 'LIKE', '%cientific%')
                                                ->get();

        // usuarios asignados a la obra que estén activos
        $persona_realiza_analisis  = ObrasUsuariosAsignados::selectRaw('
                                                                            users.id,
                                                                            users.name
                                                                        ')
                                                            ->join('users', 'users.id', '=', 'obras__usuarios_asignados.usuario_id')
                                                            ->join('obras__solicitudes_analisis', 'obras__solicitudes_analisis.obra_id', '=', 'obras__usuarios_asignados.obra_id')
                                                            ->where('obras__usuarios_asignados.status', '=', 'Activo')
                                                            ->where('obras__solicitudes_analisis.obra_id', '=', $obra_id)
                                                            ->get();
                                                            
        return view('dashboard.obras.detalle.resultados-analisis.agregar', ["registro" => $registro, 'formas_obtencion' => $formas_obtencion, 'tipos_material' => $tipos_material, 'solicitud' => $solicitud, 'asesor_cientifico_responsable' => $asesor_cientifico_responsable, 'persona_realiza_analisis' => $persona_realiza_analisis]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()){
            // ARRAY DE INTERPRETACIONES PARTICULARES DE ESTE RESULTADO DE ANALISIS
            $interpretaciones_particulares_desde_form_id    = $request->input('interpretaciones_particulares_id');
            $interpretaciones_particulares_desde_db_id      = ObrasResultadosAnalisisInterpretacionesParticulares::select(['obras__tipo_material__interpretacion_particular_id'])
                                                                ->where('obras__resultados_analisis_id', '=', $id)
                                                                ->get()
                                                                ->toArray();
            $interpretaciones_particulares_desde_db_id      = Arr::flatten($interpretaciones_particulares_desde_db_id);

            foreach ($interpretaciones_particulares_desde_form_id as $interpretacion_particular_id) {
                // SI NO ENCUENTRA LA INTERPRETACIÓN PARTICULAR DE ESTE RESULTADO DE ANALISIS SE CREA 
                // if (!ObrasResultadosAnalisisInterpretacionesParticulares::where('obras__resultados_analisis_id', '=', $id)->where('obras__tipo_material__interpretacion_particular_id', '=', $interpretacion_particular_id)->first() ) {
                if (! in_array($interpretacion_particular_id, $interpretaciones_particulares_desde_db_id)) {
                    
                    $interpretacion_particular = new ObrasResultadosAnalisisInterpretacionesParticulares;

                    $interpretacion_particular->obras__resultados_analisis_id                       = $id;
                    $interpretacion_particular->obras__tipo_material__interpretacion_particular_id  = $interpretacion_particular_id;
                    $interpretacion_particular->save();
                }
            }
            // COMO LA VARIABLE LO DICE, ELIMINA LAS INTERPRETACIONES PARTICULARES QUE NO LLEGAN DESDE EL FORM
            $elimina_los_que_no_llegan  = ObrasResultadosAnalisisInterpretacionesParticulares::select(['obras__tipo_material__interpretacion_particular_id'])
                                            ->where('obras__resultados_analisis_id', '=', $id)
                                            ->whereNotIn('obras__tipo_material__interpretacion_particular_id', $interpretaciones_particulares_desde_form_id)
                                            ->delete();
            // dd($interpretaciones_particulares_desde_form_id, $elimina_los_que_no_llegan);

            $data   = $request->all();

            return BD::actualiza($id, "ObrasResultadosAnalisis", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function eliminar(Request $request, $id)
    {
        $registro   =   ObrasResultadosAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.eliminar', ["registro" => $registro]);
    }

    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasResultadosAnalisis");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function interpretacionesParticularesSelect2(Request $request){
        if($request->ajax()){
            $tipo_material_id                               = $request->input('tipo_material_id');
            $resultado_analisis_id                          = $request->input('resultado_analisis_id');
            $interpretaciones_de_este_resultado_analitico   = ObrasResultadosAnalisisInterpretacionesParticulares::select(['obras__tipo_material__interpretacion_particular_id'])
                                                            ->where('obras__resultados_analisis_id', '=', $resultado_analisis_id)
                                                            ->get();

            $interpretaciones_particulares_cruzadas         = ObrasTipoMaterialInterCruzada::selectRaw("
                                                                obras__tipo_material__inter_cruzada.interpretacion_particular_cruzada_id AS id,
                                                                obras__tipo_material__interpretacion_particular.nombre
                                                            ")
                                                            ->join('obras__tipo_material__interpretacion_particular', 'obras__tipo_material__interpretacion_particular.id', '=', 'obras__tipo_material__inter_cruzada.interpretacion_particular_cruzada_id')
                                                            ->where('obras__tipo_material__inter_cruzada.tipo_material_cruzada_iter_id', '=', $tipo_material_id)
                                                            ->get();

            $array          = [];

            $a              = [];
            $a["id"]        = "";
            $a["text"]      = "";
            $a["selected"]  = false;
            array_push($array, $a);

            // dd($interpretaciones_particulares_cruzadas, $interpretaciones_de_este_resultado_analitico);
            foreach($interpretaciones_particulares_cruzadas as $interpretacion_particular) {
                $a              = [];
                $a["id"]        = $interpretacion_particular->id;
                $a["text"]      = $interpretacion_particular->nombre;
                $a["selected"]  = false;

                foreach ($interpretaciones_de_este_resultado_analitico as $interpretacion_particular_de_este_resultado) {
                    if ($interpretacion_particular->id == $interpretacion_particular_de_este_resultado->obras__tipo_material__interpretacion_particular_id) {
                        $a["selected"] = true;
                    }
                }

                array_push($array, $a);
            }

            return json_encode($array);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    ##### BITACORA DE APROBACIÓN - RECHAZO RESULTADOS ANÁLISIS #########################################
    public function modalAprobarResultadoAnalisis(Request $request, $id){
        $registro   = ObrasResultadosAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.aprobar-resultado-analisis', ["registro" => $registro]);
    }

    public function aprobarResultadoAnalisis(Request $request, $id){
        if($request->ajax()){
            $resultado_analisis                     = ObrasResultadosAnalisis::findOrFail($id);

            $resultado_analisis->usuario_aprobo_id  = Auth::id();
            $resultado_analisis->estatus            = 'Aprobado';
            $resultado_analisis->motivo_de_rechazo  = $request->motivo_de_rechazo;
            $resultado_analisis->fecha_aprobacion   = Carbon::now();
            $resultado_analisis->save();

            return Response::json(["mensaje" => "Resultado aprobado exitosamente.", "id" => $resultado_analisis->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalRechazarResultadoAnalisis(Request $request, $id){
        $registro   = ObrasResultadosAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.rechazar-resultado-analisis', ["registro" => $registro]);
    }

    public function rechazarResultadoAnalisis(Request $request, $id){
        if($request->ajax()){
            $resultado_analisis                     = ObrasResultadosAnalisis::findOrFail($id);

            $resultado_analisis->usuario_rechazo_id = Auth::id();
            $resultado_analisis->estatus            = 'Rechazado';
            $resultado_analisis->motivo_de_rechazo  = $request->motivo_de_rechazo;
            $resultado_analisis->fecha_rechazo      = Carbon::now();
            $resultado_analisis->save();

            return Response::json(["mensaje" => "Resultado rechazado exitosamente.", "id" => $resultado_analisis->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function modalEnRevisionResultadoAnalisis(Request $request, $id){
        $registro   = ObrasResultadosAnalisis::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.poner-en-revision-resultado-analisis', ["registro" => $registro]);
    }

    public function enRevisionResultadoAnalisis(Request $request, $id){
        if($request->ajax()){
            $resultado_analisis                     = ObrasResultadosAnalisis::findOrFail($id);

            $resultado_analisis->usuario_reviso_id  = Auth::id();
            $resultado_analisis->estatus            = 'En revision';
            $resultado_analisis->fecha_revision     = Carbon::now();
            $resultado_analisis->save();

            return Response::json(["mensaje" => "Resultado puesto en revisión exitosamente.", "id" => $resultado_analisis->id, "error" => false], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #########################################################################################################

    ##### ANALISIS A REALIZAR RESULTADOS ANALÍTICOS ########################################################
    public function cargarAnalisisRealizarResultados(Request $request, $resultado_analisis_id)
    {
        // DB::enableQueryLog();

        $registros  = ObrasAnalisisARealizarResultados::selectRaw('
                                                                    obras__resultados_analisis.id,
                                                                    obras__tipo_material__informacion_por_definir.nombre AS informacion_por_definir,
                                                                    obras__analisis_a_realizar_resultados.id AS id_resultado,
                                                                    obras__analisis_a_realizar.nombre AS analisis_a_realizar_nombre,
                                                                    obras__analisis_a_realizar_tecnica.nombre AS tecnica_analitica_nombre,
                                                                    obras__analisis_a_realizar_resultados.interpretacion
                                                                ')
                                                    ->join('obras__resultados_analisis',                        'obras__analisis_a_realizar_resultados.resultado_analisis_id',                  '=', 'obras__resultados_analisis.id')
                                                    ->join('obras__analisis_a_realizar',                        'obras__analisis_a_realizar.id',                                                '=', 'obras__analisis_a_realizar_resultados.analisis_a_realizar_id')
                                                    ->join('obras__analisis_a_realizar_tecnica',                'obras__analisis_a_realizar_tecnica.id',                                        '=', 'obras__analisis_a_realizar_resultados.tecnica_analitica_id')
                                                    ->join('obras__tipo_material__informacion_por_definir',     'obras__tipo_material__informacion_por_definir.id',                             '=', 'obras__analisis_a_realizar_resultados.informacion_por_definir_id')
                                                    ->where('obras__analisis_a_realizar_resultados.resultado_analisis_id', '=', $resultado_analisis_id)
                                                    ->get();
                                                    // ->toSql();
        // print_r('<pre>');
        // print_r(DB::getQueryLog());
        // exit;

        return DataTables::of($registros)
                        ->editColumn('imagen', function($registro){
                            $img    = ObrasAnalisisARealizarMicrofotografia::where('analisis_a_realizar_resultado_id',$registro->id_resultado)->first();
                            $altura = 40;

                            $imagen = '<p id="index-resultados-analiticos_'.$registro->id_resultado.'"><a href="'.asset('img/predeterminadas/sin_imagen.png').'" data-gallery="#galeria-index-resultados-analiticos_'.$registro->id_resultado.'"><img src="'.asset('img/predeterminadas/sin_imagen.png').'" height="'.$altura.'"></a></p>';
                            
                            if ($img != NULL) {
                                $imagen = '<p id="index-resultados-analiticos_'.$registro->id_resultado.'"><a href="'. asset('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$img->imagen) .'" '. (stripos($img->imagen, '.pdf') == true ? 'target="_blank"' : 'data-gallery="#galeria-index-resultados-analiticos_'.$registro->id_resultado.'"') .' ><img src="'.asset('img/'. (stripos($img->imagen, '.pdf') == true ? 'predeterminadas/imagen-pdf.png' : 'obras/resultados-analisis-esquema-analiticos-microfotografia/'.$img->imagen ) ).'" height="'.$altura.'"></a></p>';
                            }
                            
                            return $imagen;
                        })
                        ->addColumn('acciones', function($registro){
                            $editar     = '<i onclick="editarDatosAnaliticos('.$registro->id_resultado.')" class="fa fa-search fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Editar resultado de analisis"></i>';
                            // $analiticos = '<i onclick="agregarDatosAnaliticos('.$registro->id.')" class="fa fa-plus fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Agregar datos analíticos"></i>';
                            $eliminar   = '<i onclick="eliminarDatosAnaliticos('.$registro->id_resultado.')" class="fa fa-trash fa-lg m-r-sm pointer inline-block" aria-hidden="true"  mi-tooltip="Eliminar resultado de analisis"></i>';

                            return $editar.$eliminar;
                        })
                        ->rawColumns(['imagen','acciones'])
                        ->make('true');
    }

    public function crearResultadoAnalitico()
    {
        $registro                                   = new ObrasAnalisisARealizarResultados;
        // $tipos_material_informacion_por_definir     = ObrasTipoMaterialInformacionPorDefinir::all();
        $analisis_a_realizar                        = ObrasAnalisisARealizar::all();
        $analisis_a_realizar_informacion_del_equipo = ObrasAnalisisARealizarInformacionDelEquipo::all();

        // return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.agregar', ['registro' => $registro, 'tipos_material_informacion_por_definir' => $tipos_material_informacion_por_definir, 'analisis_a_realizar' => $analisis_a_realizar, 'analisis_a_realizar_tecnicas' => $analisis_a_realizar_tecnicas]);
        return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.agregar', ['registro' => $registro, 'analisis_a_realizar' => $analisis_a_realizar, 'analisis_a_realizar_informacion_del_equipo' => $analisis_a_realizar_informacion_del_equipo]);
    }

    public function guardarResultadoAnalitico(Request $request)
    {
        if($request->ajax()){
            return BD::crear('ObrasAnalisisARealizarResultados', $request);
        }

        return Response::json(["mensaje" => "Petición incorrecta guardar resultado analitico"], 500);
    }

    public function editarResultadoAnalitico(Request $request, $id)
    {
        $registro                                   = ObrasAnalisisARealizarResultados::findOrFail($id);
        // $tipos_material_informacion_por_definir     = ObrasTipoMaterialInformacionPorDefinir::all();
        $analisis_a_realizar                        = ObrasAnalisisARealizar::all();
        $analisis_a_realizar_informacion_del_equipo = ObrasAnalisisARealizarInformacionDelEquipo::all();
                                                            
        // return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.agregar', ['registro' => $registro, 'tipos_material_informacion_por_definir' => $tipos_material_informacion_por_definir, 'analisis_a_realizar' => $analisis_a_realizar, 'analisis_a_realizar_tecnicas' => $analisis_a_realizar_tecnicas]);
        return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.agregar', ['registro' => $registro, 'analisis_a_realizar' => $analisis_a_realizar, 'analisis_a_realizar_informacion_del_equipo' => $analisis_a_realizar_informacion_del_equipo]);
    }

    public function actualizarResultadoAnalitico(Request $request, $id)
    {
        if($request->ajax()){
            $data   = $request->all();

            return BD::actualiza($id, "ObrasAnalisisARealizarResultados", $data);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function avisoEliminarResultadoAnalitico(Request $request, $id)
    {
        $registro   =   ObrasAnalisisARealizarResultados::findOrFail($id);
        return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.eliminar', ["registro" => $registro]);
    }

    public function destruirResultadoAnalitico(Request $request, $id)
    {
        if($request->ajax()){
            return BD::elimina($id, "ObrasAnalisisARealizarResultados");
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function informacionPorDefinirSelect2(Request $request){
        if($request->ajax()){
            $tipo_material_id       = $request->input('tipo_material_id');
            $editando_informacion   = false;
            
            if ($request->has('resultado_analitico_id')) {
                $resultado_analitico_id = $request->input('resultado_analitico_id');
                $resultado_analitico    = ObrasAnalisisARealizarResultados::find($resultado_analitico_id);
                $editando_informacion   = true;
            }

            $informaciones_por_definir  = ObrasTipoMaterialInfoCruzada::selectRaw("
                                            obras__tipo_material__info_cruzada.informacion_por_definir_cruzada_id AS id,
                                            obras__tipo_material__informacion_por_definir.nombre
                                        ")
                                        ->join('obras__tipo_material__informacion_por_definir', 'obras__tipo_material__informacion_por_definir.id', '=', 'obras__tipo_material__info_cruzada.informacion_por_definir_cruzada_id')
                                        ->where('obras__tipo_material__info_cruzada.tipo_material_cruzada_info_id', '=', $tipo_material_id)
                                        ->get();

            $array              = [];

            $a                  = [];
            $a["id"]            = "";
            $a["text"]          = "";
            $a["selected"]      = false;
            array_push($array, $a);

            foreach($informaciones_por_definir as $informacion_por_definir) {
                $a              = [];
                $a["id"]        = $informacion_por_definir->id;
                $a["text"]      = $informacion_por_definir->nombre;
                $a["selected"]  = false;

                if ($editando_informacion == true) {
                    if ($informacion_por_definir->id == $resultado_analitico->informacion_por_definir_id) {
                        $a["selected"] = true;
                    }
                }

                array_push($array, $a);
            }

            return json_encode($array);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function tecnicaAnaliticaSelect2(Request $request){
        if($request->ajax()){
            $analisis_a_realizar_id = $request->input('analisis_a_realizar_id');
            $editando_tecnica       = false;
            
            if ($request->has('resultado_analitico_id')) {
                $resultado_analitico_id = $request->input('resultado_analitico_id');
                $resultado_analitico    = ObrasAnalisisARealizarResultados::find($resultado_analitico_id);
                $editando_tecnica       = true;
            }

            $tecnicas                   = ObrasAnalisisARealizarTecnica::selectRaw("
                                            *
                                        ")
                                        ->where('obras__analisis_a_realizar_tecnica.analisis_a_realizar_id', '=', $analisis_a_realizar_id)
                                        ->get();

            $array              = [];

            $a                  = [];
            $a["id"]            = "";
            $a["text"]          = "";
            $a["selected"]      = false;
            array_push($array, $a);

            foreach ($tecnicas as $tecnica) {
                $a              = [];
                $a["id"]        = $tecnica->id;
                $a["text"]      = $tecnica->nombre;

                if ($editando_tecnica == true) {
                    if ($tecnica->id == $resultado_analitico->tecnica_analitica_id) {
                        $a["selected"] = true;
                    }
                }

                array_push($array, $a);
            }

            return json_encode($array);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
    #########################################################################################################

    ##### ESQUEMA MUESTRA ##########################################################################
        public function verEsquemaMuestra(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                $registro   = ObrasResultadosAnalisis::findOrFail($resultado_analisis_id);
                return view('dashboard.obras.detalle.resultados-analisis.esquema-muestra.ver', ["esquema_muestra" => $registro->imagenes_resultados_esquema_muestra]);
            }
            
            return "";
        }

        public function subirImagenEsquemaMuestra(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                          =   new ObrasResultadosAnalisisEsquemaMuestra;
                $imagenEsquema->resultado_analisis_id   =   $resultado_analisis_id;
                $imagenEsquema->imagen                  =   "temp";
                $imagenEsquema->save();

                $extension                              =   $request->file('file')->extension();
                $nombre                                 =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/resultados-analisis-esquema-muestra/", 600) == ""){
                    $imagenEsquema->imagen              =   $nombre;
                    $imagenEsquema->save();

                    DB::commit();
                    return Response::json(["mensaje" => "Imagen subida correctamente", "id" => $imagenEsquema->id, "error" => false], 200);
                }else{
                    DB::rollback();
                    return Response::json(["mensaje" => "Error subiendo imagen"], 500);
                }
            }

            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }

        public function alertaEliminarEsquemaMuestra(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasResultadosAnalisisEsquemaMuestra::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.resultados-analisis.esquema-muestra.eliminar', ["registro" => $imagen]);
        }

        public function eliminarEsquemaMuestra(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasResultadosAnalisisEsquemaMuestra::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasResultadosAnalisisEsquemaMuestra");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/resultados-analisis-esquema-muestra/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################

    ##### ESQUEMA MICROFOTOGRAFÍA ##################################################################
        public function verEsquemaMicrofotografia(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                $registro   = ObrasResultadosAnalisis::findOrFail($resultado_analisis_id);
                return view('dashboard.obras.detalle.resultados-analisis.esquema-microfotografia.ver', ["esquema_microfotografia" => $registro->imagenes_resultados_esquema_microfotografia]);
            }
            
            return "";
        }

        public function subirImagenEsquemaMicrofotografia(Request $request, $resultado_analisis_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                          =   new ObrasResultadosAnalisisEsquemaMicrofotografia;
                $imagenEsquema->resultado_analisis_id   =   $resultado_analisis_id;
                $imagenEsquema->imagen                  =   "temp";
                $imagenEsquema->save();

                $extension                              =   $request->file('file')->extension();
                $nombre                                 =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/resultados-analisis-esquema-microfotografia/", 600) == ""){
                    $imagenEsquema->imagen              =   $nombre;
                    $imagenEsquema->save();

                    DB::commit();
                    return Response::json(["mensaje" => "Imagen subida correctamente", "id" => $imagenEsquema->id, "error" => false], 200);
                }else{
                    DB::rollback();
                    return Response::json(["mensaje" => "Error subiendo imagen"], 500);
                }
            }

            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }

        public function alertaEliminarEsquemaMicrofotografia(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasResultadosAnalisisEsquemaMicrofotografia::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.resultados-analisis.esquema-microfotografia.eliminar', ["registro" => $imagen]);
        }

        public function eliminarEsquemaMicrofotografia(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasResultadosAnalisisEsquemaMicrofotografia::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasResultadosAnalisisEsquemaMicrofotografia");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/resultados-analisis-esquema-microfotografia/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################
    
    ##### ESQUEMA DATOS ANALÍTICOS MICROFOTOGRAFÍA ##########################################################
        public function verEsquemaAnaliticosMicrofotografia(Request $request, $analisis_a_realizar_resultado_id){
            if($request->ajax()){
                $registro   = ObrasAnalisisARealizarResultados::findOrFail($analisis_a_realizar_resultado_id);
                return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.esquema-analiticos-microfotografia.ver', ["imagenes_esquema_analiticos_microfotografia" => $registro->esquema_analiticos_microfotografias]);
            }
            
            return "";
        }

        public function subirImagenEsquemaAnaliticosMicrofotografia(Request $request, $analisis_a_realizar_resultado_id){
            if($request->ajax()){
                DB::beginTransaction();

                $imagenEsquema                                      =   new ObrasAnalisisARealizarMicrofotografia;
                $imagenEsquema->analisis_a_realizar_resultado_id    =   $analisis_a_realizar_resultado_id;
                $imagenEsquema->imagen                              =   "temp";
                $imagenEsquema->save();
                // dd($request->file('file')->getMimeType());
                // dd(public_path());
                $extension                                          =   $request->file('file')->extension();
                $nombre                                             =   $imagenEsquema->id.".".$extension;

                if(Archivos::subirImagen($request->file('file'), $nombre, "img/obras/resultados-analisis-esquema-analiticos-microfotografia/", 600) == ""){
                    $imagenEsquema->imagen              =   $nombre;
                    $imagenEsquema->save();

                    DB::commit();
                    return Response::json(["mensaje" => "Imagen subida correctamente", "id" => $imagenEsquema->id, "error" => false], 200);
                }else{
                    DB::rollback();
                    return Response::json(["mensaje" => "Error subiendo imagen"], 500);
                }
            }

            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }

        public function alertaEliminarEsquemaAnaliticosMicrofotografia(Request $request, $imagen_esquema_id){
            $imagen     =   ObrasAnalisisARealizarMicrofotografia::findOrFail($imagen_esquema_id);
            return view('dashboard.obras.detalle.resultados-analisis.datos-analiticos.esquema-analiticos-microfotografia.eliminar', ["registro" => $imagen]);
        }

        public function eliminarEsquemaAnaliticosMicrofotografia(Request $request, $imagen_esquema_id){
            if($request->ajax()){
                $registro   =   ObrasAnalisisARealizarMicrofotografia::find($imagen_esquema_id);
                $response   =   BD::elimina($imagen_esquema_id, "ObrasAnalisisARealizarMicrofotografia");

                if($response->status() == 200){
                    Archivos::eliminarArchivo('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$registro->imagen);
                }

                return $response;
            }
            return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
    #########################################################################################################
}
