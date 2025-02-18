@extends('layouts.dashboard', ['menu' => "obras"])

@section('top-body')
    <input type="hidden" id="accion" value="{{ $accion }}">
    <div class="col-sm-8">
        {{-- span id folio_obra obra se usa para obtener el folio y pasarlo al listado de muestras de las solicitudes de analisis con jquery --}}
        <h2>Detalle de obra <strong><span id="folio_obra">{{ $obra->folio }}</span></strong></h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('dashboard.obras.index') }}">Obras</a>
            </li>
            <li class="active">
                {{-- span id nombre_obra obra se usa para obtener el nombre y pasarlo al listado de muestras de las solicitudes de analisis con jquery --}}
                <strong><span id="nombre_obra">{{ $obra->nombre }}</span></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        @if (Auth::user()->rol->edicion_de_registro_avanzada_2)
            <div class="m-t-md pull-right">
                <input id="disponible_consulta" type="checkbox" class="js-switch" {{ $obra->disponible_consulta ? "checked" : "" }} onchange="cambiarEstatusObra({{ $obra->id }});" />
            </div>
        @endif

        @if (Auth::user()->rol->imprimir_oficios)
        <a href="{{ route('dashboard.obras.imprimir-oficio-salida', $obra->id) }}" target="_blank"><button class="btn btn-outline btn-info dim m-t-md pull-right" type="button">Salida <i class="fa fa-file-pdf-o"></i></button></a>
            <a href="{{ route('dashboard.obras.imprimir-oficio', $obra->id) }}" target="_blank"><button class="btn btn-outline btn-primary dim m-t-md pull-right" type="button">Entrada <i class="fa fa-file-pdf-o"></i></button></a>
        @endif

        @if (Auth::user()->rol->imprimir)
            <a href="{{ route('dashboard.obras.imprimir', $obra->id) }}" target="_blank"><button class="btn btn-outline btn-success dim m-t-md pull-right" type="button">Imprimir <i class="fa fa-print"></i></button></a>
        @endif

    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-datos-generales">Datos generales</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-datos-identificacion">Datos de identificación</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-datos-generales" class="tab-pane active">
                            <div class="panel-body">
                                <div class="ibox float-e-margins">
                                    {!! Form::open(['route' => ['dashboard.obras.update', $obra->id], 'method' => 'PUT', 'id' => 'form-general', 'class' => 'form-horizontal']) !!}
                                        <div class="ibox-title" style="min-height: 65px;">
                                            <h5>Datos generales de identificación</h5>

                                            @if (Auth::user()->rol->edicion_de_registro_basica)
                                                <div id="btn-group-habilitar-edicion">
                                                    <button onclick="toggleEdicionDatosGenerales(true);" type="button" class="btn btn-primary pull-right">Editar</button> 
                                                </div>
                                                <div id="btn-group-editar" class="hidden">
                                                    <button type="submit" class="btn btn-primary pull-right m-l-sm">Guardar cambios</button> 
                                                    <button onclick="toggleEdicionDatosGenerales(false);" type="button" class="btn btn-danger pull-right">Cancelar edición</button> 
                                                </div>
                                            @endif
                                            
                                        </div>
                                        <div class="ibox-content">
                                            <div class="sk-spinner sk-spinner-double-bounce" id="carga-form-general">
                                                <div class="sk-double-bounce1"></div>
                                                <div class="sk-double-bounce2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6 div-input required">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $obra->nombre }}" required autocomplete="off" disabled>
                                                        </div>

                                                        <div class="col-md-3 div-input required">
                                                            <label for="tipo_bien_cultural_id">Tipo de bien cultural</label>
                                                            <select class="form-control select2" id="tipo_bien_cultural_id" name="tipo_bien_cultural_id" required autocomplete="off" disabled>
                                                                <option value=""></option>
                                                                @foreach ($tiposBienCultural as $bienCultural)
                                                                    <option {{ $bienCultural->id == $obra->tipo_bien_cultural_id ? "selected" : "" }} id="tipo-bien-cultural-{{ $bienCultural->id }}" calcular-temporalidad="{{ $bienCultural->calcular_temporalidad }}" value="{{ $bienCultural->id }}">{{ $bienCultural->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-3 div-input required">
                                                            <label for="tipo_objeto_id">Tipo de objeto</label>
                                                            <select class="form-control select2" id="tipo_objeto_id" name="tipo_objeto_id" required autocomplete="off" disabled>
                                                                <option value=""></option>
                                                                @foreach ($tiposObjeto as $objeto)
                                                                    <option {{ $objeto->id == $obra->tipo_objeto_id ? "selected" : "" }} value="{{ $objeto->id }}">{{ $objeto->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6 div-input required" id="div-cultura">
                                                            <label for="cultura">Cultura</label>
                                                            <input type="text" class="form-control" id="cultura" name="cultura" value="{{ $obra->cultura }}" required autocomplete="off" disabled>
                                                        </div>

                                                        <div class="col-md-6 div-input required" id="div-temporalidad">
                                                            <label for="temporalidad_id">Temporalidad</label>
                                                            <select class="form-control select2 full-width" id="temporalidad_id" name="temporalidad_id" required autocomplete="off" disabled>
                                                                <option value=""></option>
                                                                @foreach ($temporalidades as $temporalidad)
                                                                    <option {{ $obra->temporalidad_id == $temporalidad->id ? "selected" : "" }} value="{{ $temporalidad->id }}">{{ $temporalidad->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-12 div-input required" id="div-autor">
                                                    <label for="autor">Autor</label>
                                                    <input type="text" class="form-control" id="autor" name="autor" value="{{ $obra->autor }}" required autocomplete="off" disabled>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div id="div-epoca">
                                                            <div class="col-md-4 div-input required">
                                                                <label for="epoca_id">Época</label>
                                                                <select class="form-control select2 full-width" name="epoca_id" id="epoca_id" required autocomplete="off" disabled>
                                                                    <option value=""></option>
                                                                    @foreach ($epocas as $epoca)
                                                                        <option {{ $obra->epoca_id == $epoca->id ? "selected" : "" }} value="{{ $epoca->id }}">{{ $epoca->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2 div-input">
                                                                <label for="estatus_epoca">Estatus</label>
                                                                <select class="form-control select2 full-width" name="estatus_epoca" id="estatus_epoca" disabled>
                                                                    <option value=""></option>
                                                                    @foreach (config('valores.status_años_obras') as $status)
                                                                        <option {{ $obra->estatus_epoca == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div id="div-año">
                                                            <div class="col-md-4 div-input">
                                                                <label for="año">Año</label>
                                                                <input type="text" class="form-control" id="año" name="año" value="{{ $obra->año ? $obra->año->format('Y') : '' }}" required autocomplete="off" disabled>
                                                            </div>
                                                            <div class="col-md-2 div-input">
                                                                <label for="estatus_año">Estatus</label>
                                                                <select class="form-control select2 full-width" name="estatus_año" id="estatus_año" disabled>
                                                                    <option value=""></option>
                                                                    @foreach (config('valores.status_años_obras') as $status)
                                                                        <option {{ $obra->estatus_año == $status ? "selected" : "" }} value="{{ $status }}">{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 div-input required">
                                                    <label for="lugar_procedencia_actual">Lugar de procedencia actual</label>
                                                    <input type="text" class="form-control" id="lugar_procedencia_actual" name="lugar_procedencia_actual" value="{{ $obra->lugar_procedencia_actual }}" required autocomplete="off" disabled placeholder="Ubicación o custodio" mi-tooltip="Ubicación o custodio.">
                                                </div>
                                                <div class="col-md-5 div-input required">
                                                    <label for="lugar_procedencia_original">Lugar de procedencia original</label>
                                                    <input type="text" class="form-control" id="lugar_procedencia_original" name="lugar_procedencia_original" value="{{ $obra->lugar_procedencia_original }}" required autocomplete="off" disabled placeholder="Lugar de donde proviene la obra/creación." mi-tooltip="Lugar de donde proviene la obra/creación.">
                                                </div>
                                                
                                                <div class="col-md-2 div-input required">
                                                    <label for="numero_inventario">No inventario</label>
                                                    <input type="text" class="form-control" id="numero_inventario" name="numero_inventario" value="{{ $obra->numero_inventario }}" required autocomplete="off" disabled {{ Auth::user()->rol->edicion_de_registro_avanzada_1 ? "" : "no-editar" }}>
                                                </div>

                                                <div class="col-md-3 div-input required">
                                                    <label for="alto">Alto (cm)</label>
                                                    <input type="number" class="form-control" min="0" id="alto" name="alto" value="{{ $obra->alto }}" required autocomplete="off" disabled>
                                                </div>
                                                <div class="col-md-3 div-input required">
                                                    <label for="ancho">Ancho (cm)</label>
                                                    <input type="number" class="form-control" min="0" id="ancho" name="ancho" value="{{ $obra->ancho }}" required autocomplete="off" disabled>
                                                </div>
                                                <div class="col-md-3 div-input">
                                                    <label for="profundidad">Profundidad (cm)</label>
                                                    <input type="number" class="form-control" min="0" id="profundidad" name="profundidad" value="{{ $obra->profundidad }}" autocomplete="off" disabled>
                                                </div>
                                                <div class="col-md-3 div-input">
                                                    <label for="diametro">Diámetro (cm)</label>
                                                    <input type="number" class="form-control" min="0" id="diametro" name="diametro" value="{{ $obra->diametro }}" autocomplete="off" disabled>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="dropzone-obra-imagenes-principales">Imagenes principales</label>
                                                        </div>
                                                        <div class="col-md-12 div-input required hidden {{-- dropzones-imagenes --}}" id="dropzone-imagenes-principales-ocultas" {{-- style="display: none;" --}}>
                                                            <div class="dropzone" id="dropzone-obra-imagenes-principales">
                                                            </div>
                                                        </div>
                                                    </div>      

                                                    <div class="row m-t-md center-block">
                                                        @include('dashboard.obras.detalle.imagenes-principales.ver', ["imagenes_principales" => $obra->imagenes_principales])
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <input type="hidden" id="calcular-temporalidad" name="calcular-temporalidad">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div id="tab-datos-identificacion" class="tab-pane">
                            {!! Form::open(['route' => ['dashboard.obras.update', $obra->id], 'method' => 'PUT', 'id' => 'form-datos-identificacion', 'class' => 'form-horizontal']) !!}
                                <div class="panel-body">
                                    <div class="row m-b-md">
                                        <div class="col-md-8" id="div-respuesta-datos-identificacion"></div>
                                        <div class="col-md-4">

                                            @if (Auth::user()->rol->edicion_de_registro_avanzada_1 || Auth::user()->rol->edicion_de_registro_avanzada_2)
                                                <div id="btn-group-habilitar-edicion-datos-identificacion">
                                                    <button onclick="toggleEdicionDatosIdentificacion(true);" type="button" class="btn btn-primary pull-right">Editar</button> 
                                                </div>
                                                <div id="btn-group-editar-datos-identificacion" class="hidden">
                                                    <button type="submit" class="btn btn-primary pull-right m-l-sm">Guardar cambios</button> 
                                                    <button onclick="toggleEdicionDatosIdentificacion(false);" type="button" class="btn btn-danger pull-right">Cancelar edición</button> 
                                                </div>
                                            @endif
                                            
                                        </div>    
                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="col-md-12">

                                            @if (Auth::user()->rol->acceso_a_datos_avanzado)
                                                <div class="row">
                                                    <div class="col-md-12 div-input">
                                                        <label for="caracteristicas_descriptivas">Características descriptivas</label>
                                                        <textarea class="form-control no-resize" name="caracteristicas_descriptivas" id="caracteristicas_descriptivas" rows="6" autocomplete="off" disabled>{{ $obra->caracteristicas_descriptivas }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-9 div-input required">
                                                    <label for="_responsables">Responsables ECRO</label>
                                                    <select class="form-control select2 full-width" id="_responsables" name="_responsables[]" required autocomplete="off" multiple="" disabled>
                                                        <option value=""></option>
                                                        @foreach ($responsablesEcro as $responsable)
                                                            <option {{ $obra->responsables_asignados->where('id', $responsable->id)->first() ? "selected" : "" }} value="{{ $responsable->id }}">{{ $responsable->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if (Auth::user()->rol->acceso_a_datos_avanzado)
                                                    <div class="col-md-3 div-input required">
                                                        <label for="forma_ingreso">Forma de ingreso</label>
                                                        <select class="form-control select2 full-width" id="forma_ingreso" name="forma_ingreso" required autocomplete="off" disabled>
                                                            <option value=""></option>
                                                            @foreach (config('valores.obras_formas_ingreso') as $forma)
                                                                <option {{ $obra->forma_ingreso == $forma ? "selected" : "" }} value="{{ $forma }}">{{ $forma }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 div-input required">
                                                    <label for="area_id">Área</label>
                                                    <select class="form-control select2 full-width" id="area_id" name="area_id" required autocomplete="off" disabled>
                                                        <option value=""></option>
                                                        @foreach ($areas as $area)
                                                            <option {{ $obra->area_id == $area->id ? "selected" : "" }} value="{{ $area->id }}">{{ $area->campo }} {{ $area->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 div-input">
                                                    <label for="area_id">Modalidad</label>
                                                    <select class="form-control select2 full-width" id="modalidad" name="modalidad" autocomplete="off" disabled>
                                                        <option value="">Sin Modalidad</option>
                                                        @foreach (config('valores.modalidades') as $modalidad)
                                                            <option {{ $obra->modalidad == $modalidad ? "selected" : "" }} value="{{ $modalidad }}">{{ $modalidad }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row {{ is_null($obra->area_id) ? "hidden" : "" }}" id="div-proyecto">
                                                <div class="col-md-12 div-input">
                                                    <label for="area_id">Proyecto</label>
                                                    <select class="form-control select2 full-width" id="proyecto_id" name="proyecto_id" autocomplete="off" disabled>
                                                        @if ($obra->proyecto)
                                                            <option value="{{ $obra->proyecto_id }}">{{ $obra->proyecto->nombre }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row {{ is_null($obra->area_id) ? "hidden" : "" }}" id="div-temporadas-trabajo">
                                                <div class="col-md-12 div-input">
                                                    <label for="_temporadas_trabajo">Temporadas de trabajo</label>
                                                    <select class="form-control select2 full-width" id="_temporadas_trabajo" name="_temporadas_trabajo[]" autocomplete="off" disabled multiple="multiple">
                                                        @foreach ($obra->temporadas_trabajo_asignadas as $temporada_trabajo)
                                                            <option selected value="{{ $temporada_trabajo->id }}">{{ $temporada_trabajo->numero_temporada }} [{{ $temporada_trabajo->año }}]</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            @if (Auth::user()->rol->acceso_a_datos_avanzado)
                                                <div class="row">
                                                    <div class="col-md-6 div-input required">
                                                        <label for="fecha_ingreso">Fecha ingreso</label>
                                                        <input type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="{{ $obra->fecha_ingreso ? $obra->fecha_ingreso->format('Y-m-d') : Carbon\Carbon::now()->format('Y-m-d') }}" required autocomplete="off" disabled>
                                                    </div>
                                                    <div class="col-md-6 div-input">
                                                        <label for="fecha_salida">Fecha salida</label>
                                                        <input type="text" class="form-control" id="fecha_salida" name="fecha_salida" value="{{ $obra->fecha_salida ? $obra->fecha_salida->format('Y-m-d') : "" }}" autocomplete="off" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 div-input">
                                                        <label for="area_id">Usuario que recibió (entrada)</label>
                                                        <select class="form-control select2 full-width" id="usuario_recibio_id" name="usuario_recibio_id" autocomplete="off" disabled {{ Auth::user()->rol->edicion_de_registro_avanzada_2 ? "" : "no-editar" }}>
                                                            <option value=""></option>
                                                            @foreach ($usuariosPuedenRecibirObras as $usuario)
                                                                <option {{ $obra->usuario_recibio_id == $usuario->id ? "selected" : "" }} value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 div-input">
                                                        <label for="fecha_salida">Persona que entregó (entrada)</label>
                                                        <input type="text" class="form-control" id="persona_entrego" name="persona_entrego" value="{{ $obra->persona_entrego }}" autocomplete="off" disabled {{ Auth::user()->rol->edicion_de_registro_avanzada_2 ? "" : "no-editar" }}>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 div-input">
                                                        <label for="fecha_salida">Persona que recibió (salida)</label>
                                                        <input type="text" class="form-control" id="persona_recibio" name="persona_recibio" value="{{ $obra->persona_recibio }}" autocomplete="off" disabled {{ Auth::user()->rol->edicion_de_registro_avanzada_2 ? "" : "no-editar" }}>
                                                    </div>
                                                    <div class="col-md-6 div-input">
                                                        <label for="area_id">Usuario que entregó (salida)</label>
                                                        <select class="form-control select2 full-width" id="usuario_entrego_id" name="usuario_entrego_id" autocomplete="off" disabled {{ Auth::user()->rol->edicion_de_registro_avanzada_2 ? "" : "no-editar" }}>
                                                            <option value=""></option>
                                                            @foreach ($usuariosPuedenRecibirObras as $usuario)
                                                                <option {{ $obra->usuario_entrego_id == $usuario->id ? "selected" : "" }} value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 m-b-md">
            <div class="ibox">
                <div class="tabs-container">

                    <ul class="nav nav-tabs">
                        @if (Auth::user()->rol->captura_de_responsables_intervencion)
                            <li class="active"><a data-toggle="tab" href="#tab-usuarios-asignados">Usuarios asignados</a></li>
                        @endif

                        <li class=""><a data-toggle="tab" href="#tab-restauracion-conservacion">Restauración/Conservación</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-registro-fotografico">Registro fotográfico</a></li>

                        @if (Auth::user()->rol->captura_de_solicitud_analisis)
                            {{-- SE LE PONE ID A LOS LI PARA PODER HACER EL JUEGO DE APERTURA Y CIERRE AUTOMÁTICAMENTE CON JQUERY --}}
                            <li class="" id="li-solicitudes-analisis"><a data-toggle="tab" href="#tab-solicitudes-analisis"> Solicitudes de ánalisis</a></li>
                        @endif
                        
                        @if (Auth::user()->rol->captura_de_resultados)
                            <li class="" id="li-resultados-analisis"><a data-toggle="tab" href="#tab-resultados-analisis">Resultado de análisis</a></li>
                        @endif

                        <li class=""><a data-toggle="tab" href="#tab-informes">Informes</a></li>
                    </ul>

                    <div class="tab-content">
                        @if (Auth::user()->rol->captura_de_responsables_intervencion)
                            <div id="tab-usuarios-asignados" class="tab-pane active">
                                <div class="panel-body">
                                    @include('dashboard.obras.detalle.usuarios-asignados.index')
                                </div>
                            </div>
                        @endif


                        <div id="tab-restauracion-conservacion" class="tab-pane">
                            <div class="panel-body">
                                @include('dashboard.obras.detalle.restauracion-conservacion.index')
                            </div>
                        </div>

                        <div id="tab-registro-fotografico" class="tab-pane">
                            <div class="panel-body">
                                @include('dashboard.obras.detalle.registro-fotografico.index')
                            </div>
                        </div>

                        @if (Auth::user()->rol->captura_de_solicitud_analisis)
                            <div id="tab-solicitudes-analisis" class="tab-pane">
                                <div class="panel-body">
                                    @include('dashboard.obras.detalle.solicitudes-analisis.index')
                                </div>
                            </div>
                        @endif

                        @if (Auth::user()->rol->captura_de_resultados)
                            <div id="tab-resultados-analisis" class="tab-pane">
                                <div class="panel-body">
                                    @include('dashboard.obras.detalle.resultados-analisis.index')
                                </div>
                            </div>
                        @endif                    
                        
                        <div id="tab-informes" class="tab-pane">
                            <div class="panel-body">
                                @include('dashboard.obras.detalle.informes.index')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="id" value="{{ $obra->id }}">
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/obras/detalle.js'.env('SEMILLA', '?=1')) !!}
    {!! Html::script('scripts/dashboard/obras/resultados-analisis.js'.env('SEMILLA', '?=1')) !!}
    {!! Html::script('scripts/dashboard/obras/solicitudes-analisis.js'.env('SEMILLA', '?=1')) !!}
    {!! Html::script('scripts/dashboard/obras/usuarios-asignados.js'.env('SEMILLA', '?=1')) !!}
@endsection