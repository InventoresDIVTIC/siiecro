@extends('layouts.landing')

@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <div class="single-blog-item">

                    <div class="row">
                        <div class="col-6 text-center">
                            @if ($obra->imagenes_principales->count())
                                <img src="{{ asset('/img/obras/imagenes-principales/'.$obra->imagenes_principales->first()->imagen_chica) }}" alt="" class="img-fluid">
                            @else
                                <img src="{{ asset('img/predeterminadas/sin_imagen.png') }}" alt="" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-6">
                            <h5 class="mt-3 mb-3"><i class="fa fa-list"></i>&nbsp;Datos de la obra / pieza / conjunto</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover w-auto">
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Titulo:</strong> 
                                            </span>
                                        </td>
                                        <td>{{ $obra->nombre }}</td>
                                    </tr>

                                    @if($obra->autor)
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Autor:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->autor }}</td>
                                    </tr>
                                    @endif

                                    @if($obra->cultura)
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Cultura:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->cultura }}</td>
                                    </tr>
                                    @endif

                                    @if($obra->año)
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Año:</strong>
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($obra->año)->format('Y') }}</td>
                                    </tr>
                                    @endif

                                    @if($obra->epoca)
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Época:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->epoca->nombre }}</td>
                                    </tr>
                                    @endif

                                    @if($obra->temporalidad)
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Temporalidad:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->temporalidad->nombre }}</td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Técnica:</strong>
                                            </span>
                                        </td>
                                        <td>Tecnica</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Dimensiones:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->cadenaDimensiones() }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Tipo de bien cultural:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->tipo_bien_cultural->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Tipo de objeto:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->tipo_objeto->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Lugar de procedencia original:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->lugar_procedencia_original }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>Lugar de procedencia actual:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->lugar_procedencia_actual }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="col" class="table-active">
                                            <span>
                                                <strong>No. de inventario o código de procedencia:</strong>
                                            </span>
                                        </td>
                                        <td>{{ $obra->numero_inventario }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-12">
                            <div id="acordeon">
                                <div class="card">
                                    <div class="card-header">
                                      <a class="collapsed card-link" data-toggle="collapse" href="#datos-de-identificacion">
                                        <i class="fa fa-desktop"></i>&nbsp;Datos de identificación
                                      </a>
                                    </div>
                                    <div id="datos-de-identificacion" class="collapse" data-parent="#acordeon">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered table-hover">
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>No. de Registro de obra:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $obra->folio }}
                                                                </td>
                                                            </tr>

                                                            @if(Auth::user()->rol->consulta_general_avanzada)
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>No. de Proyecto ECRO:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $obra->proyecto->folio }}
                                                                </td>
                                                            </tr>
                                                            @endif

                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>Año del proyecto:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                    @foreach( $obra->temporadas_trabajo_asignadas as $temporada_trabajo_asignada)
                                                                        <li>{{ $temporada_trabajo_asignada->año }}</li>
                                                                    @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>Área:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $obra->area->nombre }}
                                                                </td>
                                                            </tr>

                                                            @if(Auth::user()->rol->consulta_general_avanzada)
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>Características descriptivas:</strong><br>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ nl2br($obra->caracteristicas_descriptivas) }}
                                                                </td>
                                                            </tr>
                                                            @endif

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered table-hover">
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>Proyecto ECRO:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $obra->proyecto->nombre }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>No de temporadas de trabajo:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                    @php
                                                                        $sumatoria_temporadas = 0;
                                                                    @endphp
                                                                    @foreach( $obra->temporadas_trabajo_asignadas as $temporada_trabajo_asignada)
                                                                        {{-- <li>{{ $temporada_trabajo_asignada->numero_temporada }}</li> --}}
                                                                        @php
                                                                            $sumatoria_temporadas ++;
                                                                        @endphp
                                                                    @endforeach
                                                                        <p>@php echo $sumatoria_temporadas @endphp</p>
                                                                    </ul>
                                                                </td>
                                                            </tr>

                                                            @if(Auth::user()->rol->consulta_general_avanzada)
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>Forma de ingreso:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $obra->forma_ingreso }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td scope="col" class="table-active">
                                                                    <span>
                                                                        <strong>Responsables ECRO:</strong>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                    @foreach( $obra->responsables_asignados as $responsables_asignados)
                                                                        <li>{{ $responsables_asignados->name ? $responsables_asignados->name : '' }}</li>
                                                                    @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            @endif

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                      <a class="collapsed card-link" data-toggle="collapse" href="#registro-fotografico">
                                        <i class="fa fa-camera-retro"></i>&nbsp;Registro fotográfico
                                      </a>
                                    </div>
                                    <div id="registro-fotografico" class="collapse" data-parent="#acordeon">
                                      <div class="card-body">
                                        Información aún no disponible
                                      </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#analisis-cientificos">
                                            <i class="fa fa-calculator"></i>&nbsp;Análisis científicos
                                        </a>
                                    </div>
                                    
                                    <div id="analisis-cientificos" class="collapse" data-parent="#acordeon">
                                        <div class="card-body">
                                            @foreach($obra->solicitudes_analisis as $solicitudes)
                                                @foreach($solicitudes->muestras as $muestras)
                                                    <h3>Resultado de análisis</h3>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Fotografía</strong>
                                                                        </span>
                                                                    </th>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Nomenclatura</strong>
                                                                        </span>
                                                                    </th>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Lugar de resguardo</strong>
                                                                        </span>
                                                                    </th>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Grupo material</strong>
                                                                        </span>
                                                                    </th>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Material(es)</strong>
                                                                        </span>
                                                                    </th>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Temporada de trabajo</strong>
                                                                        </span>
                                                                    </th>
                                                                    <th scope="col" class="table-active">
                                                                        <span>
                                                                            <strong>Conclusión general</strong>
                                                                        </span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        @if ($muestras->resultados_analisis)
                                                                            @foreach($muestras->resultados_analisis->imagenes_resultados_esquema_muestra as $esquema_muestra)
                                                                                <a href="{{ asset('/img/obras/resultados-analisis-esquema-muestra/'.$esquema_muestra->imagen) }}" data-gallery=""><img src="{{ asset('/img/obras/resultados-analisis-esquema-muestra/'.$esquema_muestra->imagen) }}" height="80"></a>
                                                                            @endforeach
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $muestras->nomenclatura }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $muestras->resultados_analisis->lugar_resguardo_muestra ?? "N/A" }}
                                                                    </td>
                                                                    <td>
                                                                        {{-- {{ $muestras->resultados_analisis->tipo_material ? $muestras->resultados_analisis->tipo_material->nombre : '' }} --}}
                                                                        {{ $muestras->tipo_analisis->nombre }}
                                                                    </td>
                                                                    <td>
                                                                        <ul>
                                                                            @if ($muestras->resultados_analisis)
                                                                                @foreach($muestras->resultados_analisis->interpretaciones_particulares as $interpretaciones_particulares)
                                                                                    <li>{{ $interpretaciones_particulares->interpretacion_particular->nombre }}</li>
                                                                                @endforeach 
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul>
                                                                            @foreach($obra->temporadas_trabajo_asignadas as $temporadas)
                                                                                <li>{{ $temporadas->numero_temporada . ' [ ' . $temporadas->año . ' ] ' }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        {{ ($muestras->resultados_analisis->conclusion_general ?? null) ? 'CONCLUSIÓN GENERAL: ' . $muestras->resultados_analisis->conclusion_general : 'Sin conclusión general'}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="7">
                                                                        <div id="acordeon-{{ $muestras->id }}">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <a class="collapsed card-link" data-toggle="collapse" href="#mas-informacion-{{ $muestras->id }}">
                                                                                        <i class="fa fa-plus"></i>&nbsp;Más información
                                                                                    </a>
                                                                                </div>
                                                                                <div id="mas-informacion-{{ $muestras->id }}" class="collapse" data-parent="#acordeon-{{ $muestras->id }}">
                                                                                    <div class="card-body">
                                                                                        {{-- TABLA MÁS INFORMACION --}}
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-sm table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Fecha del analisis</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Persona que realizó el análisis</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Forma de obtención de la muestra</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Ubicación de la toma de muestra</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Esquema de toma de muestras</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            {{ $muestras->resultados_analisis->fecha_analisis ?? 'N/A' }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {{ $muestras->resultados_analisis->persona_analisis->name ?? 'N/A' }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {{ $muestras->resultados_analisis->forma_obtencion_muestra->nombre ?? 'N/A' }}
                                                                                                        <td>
                                                                                                            {{ $muestras->resultados_analisis->ubicacion_de_toma_muestra ?? 'N/A' }}
                                                                                                        </td>
                                                                                                        <td class="text-center">
                                                                                                            @if ($muestras->resultados_analisis)
                                                                                                                @foreach($muestras->resultados_analisis->imagenes_resultados_esquema_muestra as $esquema_muestra)
                                                                                                                    <a href="{{ asset('/img/obras/resultados-analisis-esquema-muestra/'.$esquema_muestra->imagen) }}" data-gallery=""><img src="{{ asset('/img/obras/resultados-analisis-esquema-muestra/'.$esquema_muestra->imagen) }}" height="80"></a>
                                                                                                                @endforeach
                                                                                                            @else
                                                                                                                N/A
                                                                                                            @endif
                                                                                                            
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                        {{-- CARACTERISTICAS DE OBSERVACION PRELIMINAR --}}
                                                                                        <h3>Caracteríticas de observación preliminar</h3>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-sm table-bordered table-hover">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Descripción</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Fotografía</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                        <th scope="col" class="table-active">
                                                                                                            <span>
                                                                                                                <strong>Ruta de acceso a microfotografía</strong>
                                                                                                            </span>
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            {{ $muestras->resultados_analisis->descripcion ?? 'N/A' }}
                                                                                                        </td>
                                                                                                        <td class="text-center">
                                                                                                            @if ($muestras->resultados_analisis)
                                                                                                                @foreach($muestras->resultados_analisis->imagenes_resultados_esquema_microfotografia as $esquema_muestra)
                                                                                                                    <a href="{{ asset('/img/obras/resultados-analisis-esquema-microfotografia/'.$esquema_muestra->imagen) }}" data-gallery=""><img src="{{ asset('/img/obras/resultados-analisis-esquema-microfotografia/'.$esquema_muestra->imagen) }}" height="80"></a>
                                                                                                                @endforeach
                                                                                                            @else
                                                                                                                N/A
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {{ $muestras->resultados_analisis->ruta_acceso_microfotografia ?? 'N/A' }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>

                                                                                        {{-- RESULTADOS --}}
                                                                                        @if ($muestras->resultados_analisis)
                                                                                            <h3>Resultados</h3>
                                                                                            @foreach($muestras->resultados_analisis->resultados as $resultados)
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-sm table-bordered table-hover">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th scope="col" class="table-active">
                                                                                                                    <span>
                                                                                                                        <strong>Análisis a realizar</strong>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                                <th scope="col" class="table-active">
                                                                                                                    <span>
                                                                                                                        <strong>Técnica analítica</strong>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                                <th scope="col" class="table-active">
                                                                                                                    <span>
                                                                                                                        <strong>Información del equipo</strong>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                                <th scope="col" class="table-active" style="width:250px">
                                                                                                                    <span>
                                                                                                                        <strong>Interpretación</strong>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                                <th scope="col" class="table-active">
                                                                                                                    <span>
                                                                                                                        <strong>Microfotografía/Imagen o datos</strong>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                                <th scope="col" class="table-active">
                                                                                                                    <span>
                                                                                                                        <strong>Ruta de acceso a microfotografía/imagen datos</strong>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    {{ $resultados->analisis_realizar->nombre }}
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    {{ $resultados->tecnica_analitica->nombre }}
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    {{ $resultados->informacion_del_equipo->nombre }}
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    {{ $resultados->interpretacion }}
                                                                                                                </td>
                                                                                                                <td class="text-center">
                                                                                                                    @foreach($resultados->esquema_analiticos_microfotografias as $esquema_microfotografia)
                                                                                                                        <a href="{{ asset('/img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$esquema_microfotografia->imagen) }}" data-gallery=""><img src="{{ asset('/img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$esquema_microfotografia->imagen) }}" height="80"></a>
                                                                                                                    @endforeach
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    {{ $resultados->ruta_acceso_imagen }}
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @endif
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            @endforeach        
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#informes-intervencion">
                                            <i class="fa fa-tasks"></i>&nbsp;Informes de intervención
                                        </a>
                                    </div>
                                    <div id="informes-intervencion" class="collapse" data-parent="#acordeon">
                                        <div class="card-body">
                                            Información aún no disponible
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12 text-center">
                        <img src="{{ asset('img/blog/blog-1.jpg') }}" alt="" class="img-fluid">
                    </div>

                    <div class="blog-item-content mt-5">
                        <div class="blog-item-meta mb-3">
                            <span class="text-color-2 text-capitalize mr-3"><i class="icofont-book-mark mr-2"></i> Equipment</span>
                            <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i>5 Comments</span>
                            <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-2"></i> 28th January 2019</span>
                        </div> 

                        <h2 class="mb-4 text-md"><a href="blog-single.html">Healthy environment to care with modern equipment</a></h2>

                        <p class="lead mb-4">Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus natus, consectetur? Illum libero vel nihil nisi quae, voluptatem, sapiente necessitatibus distinctio voluptates, iusto qui. Laboriosam autem, nam voluptate in beatae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae iure officia nihil nemo, repudiandae itaque similique praesentium non aut nesciunt facere nulla, sequi sunt nam temporibus atque earum, ratione, labore.</p>

                        <blockquote class="quote">
                            A brand for a company is like a reputation for a person. You earn reputation by trying to do hard things well.
                        </blockquote>

                        
                        <p class="lead mb-4 font-weight-normal text-black">The same is true as we experience the emotional sensation of stress from our first instances of social rejection ridicule. We quickly learn to fear and thus automatically.</p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, rerum beatae repellat tenetur incidunt quisquam libero dolores laudantium. Nesciunt quis itaque quidem, voluptatem autem eos animi laborum iusto expedita sapiente.</p>

                        <div class="mt-5 clearfix">
                            <ul class="float-left list-inline tag-option"> 
                                <li class="list-inline-item"><a href="#">Advancher</a></li>
                                <li class="list-inline-item"><a href="#">Landscape</a></li>
                                <li class="list-inline-item"><a href="#">Travel</a></li>
                            </ul>        

                            <ul class="float-right list-inline">
                                <li class="list-inline-item"> Share: </li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-facebook" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-pinterest" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="#" target="_blank"><i class="icofont-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

{{-- 
        <div class="mb-5 hidden" id="div-obras-recomendadas">
            <h3 class="font-weight-normal">Te recomendamos visitar:</h3>

            <div id="respuesta-obras-recomendadas">
                <h3 class="text-center">
                    Buscando obras recomendadas <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </h3>
            </div>
        </div>
 --}}
    </div>
    <input type="hidden" id="obra_id" value="{{ $obra->id }}">
@endsection

@section('scripts')
    {!! Html::script('scripts/landing/detalle.js') !!}
@endsection