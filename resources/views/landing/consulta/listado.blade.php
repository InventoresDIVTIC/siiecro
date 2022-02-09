@if (Auth::user()->rol->consulta_general_avanzada || Auth::user()->rol->consulta_general_basica)
    <div class="row">
        <div class="col-12 text-center">
            <h4>Obras Encontradas {{ $obras->total() }}</h4>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3">
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Año</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="anio">
                            <option></option>
                            @foreach($anios as $anio)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['anio'] ==  $anio->anio ? 'selected' : '' ) : '' ) : '' }} value="{{ $anio->anio }}">{{ $anio->anio }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Época</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="epoca">
                            <option></option>
                            @foreach($epocas as $epoca)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['epoca'] ==  $epoca->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $epoca->id }}">{{ $epoca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Temporalidad</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="temporalidad">
                            <option></option>
                            @foreach($temporalidades as $temporalidad)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['temporalidad'] ==  $temporalidad->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $temporalidad->id }}">{{ $temporalidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Autor</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="autor">
                            <option></option>
                            @foreach($autores as $autor)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['autor'] ==  $autor->autor ? 'selected' : '' ) : '' ) : '' }} value="{{ $autor->autor }}">{{ $autor->autor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Cultura</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="cultura">
                            <option></option>
                            @foreach($culturas as $cultura)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['cultura'] ==  $cultura->cultura ? 'selected' : '' ) : '' ) : '' }} value="{{ $cultura->cultura }}">{{ $cultura->cultura }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Lugar de procedencia actual</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="lugar_procedencia_actual">
                            <option></option>
                            @foreach($lugares_procedencia_actual as $lugar_actual)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['lugar_procedencia_actual'] ==  $lugar_actual->lugar_procedencia_actual ? 'selected' : '' ) : '' ) : '' }} value="{{ $lugar_actual->lugar_procedencia_actual }}">{{ $lugar_actual->lugar_procedencia_actual }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Lugar de procedencia original</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="lugar_procedencia_original">
                            <option></option>
                            @foreach($lugares_procedencia_original as $lugar_original)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['lugar_procedencia_original'] ==  $lugar_original->lugar_procedencia_original ? 'selected' : '' ) : '' ) : '' }} value="{{ $lugar_original->lugar_procedencia_original }}">{{ $lugar_original->lugar_procedencia_original }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Tipo de bien cultural</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="tipo_bien_cultural">
                            <option></option>
                            @foreach($tipos_bien_cultural as $tipo_bien_cultural)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['tipo_bien_cultural'] ==  $tipo_bien_cultural->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $tipo_bien_cultural->id }}">{{ $tipo_bien_cultural->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0 {{ $filtro_visible != '[]' ? $filtro_visible : '' }}">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Tipos de material</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="tipo_material">
                            <option></option>
                            @foreach($tipos_material as $tipo_material)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['tipo_material'] ==  $tipo_material->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $tipo_material->id }}">{{ $tipo_material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0 {{ $filtro_visible != '[]' ? $filtro_visible : '' }}">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Interpretación de material</h5>

                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="interpretacion_material">
                            <option></option>
                            @foreach($interpretaciones_materiales as $interpretacion_material)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['interpretacion_material'] ==  $interpretacion_material->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $interpretacion_material->id }}">{{ $interpretacion_material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            
            @if(Auth::user()->rol->consulta_general_avanzada)
            
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="area">No. Registro</label>
                        <select class="form-control filtros-administrativos" id="no-registro">
                            <option></option>
                            @foreach($obras_all as $obra_all)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['no_registro'] ==  $obra_all->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $obra_all->id }}">{{ $obra_all->folio }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="area">Area</label>
                        <select class="form-control filtros-administrativos" id="area">
                            <option></option>
                            @foreach($areas as $area)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['area'] ==  $area->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="responsable-ecro">Responsable ECRO</label>
                        <select class="form-control filtros-administrativos" id="responsable-ecro">
                            <option></option>
                            @foreach($responsables as $responsable)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['responsable_ecro'] ==  $responsable->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $responsable->id }}">{{ $responsable->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3 {{ $visibilidad_proyecto != '[]' ? $visibilidad_proyecto : '' }}">
                    <label for="proyecto-ecro">Proyecto ECRO</label>
                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="proyecto-ecro">
                            <option></option>
                            @foreach($proyectos as $proyecto)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['proyecto'] ==  $proyecto->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3 {{ $visibilidad_no_proyecto != '[]' ? $visibilidad_no_proyecto : '' }}">
                    <label for="proyecto-ecro">No. Proyecto</label>
                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="no-proyecto-ecro">
                            <option></option>
                            @foreach($proyectos as $proyecto)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['no_proyecto'] ==  $proyecto->folio ? 'selected' : '' ) : '' ) : '' }} value="{{ $proyecto->folio }}">{{ $proyecto->folio }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-3">
                    <label for="temporada-ecro">Temporada de trabajo</label>
                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="temporada-ecro">
                            <option></option>
                            @foreach($temporadas as $temporada)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['temporada'] ==  $temporada->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $temporada->id }}">{{ $temporada->año .' - '. $temporada->numero_temporada }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-3 {{ $filtro_visible != '[]' ? $filtro_visible : '' }}">
                    <label for="profe-responsable">Responsable del análisis</label>
                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="profe-responsable">
                            <option></option>
                            @foreach($profes_responsables as $profe_responsable)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['profe_responsable'] ==  $profe_responsable->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $profe_responsable->id }}">{{ $profe_responsable->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-3 {{ $filtro_visible != '[]' ? $filtro_visible : '' }}">
                    <label for="nomenclatura-muestra">Nomenclatura de la muestra</label>
                    <div class="form-group">
                        <input type="text" class="form-control filtros-administrativos" id="nomenclatura-muestra" value="{{ $filtros != null ? ($filtros != '[]' ? $filtros['nomenclatura_muestra'] : '' ) : '' }}">
                    </div>
                </div>

                <div class="col-3 {{ $filtro_visible != '[]' ? $filtro_visible : '' }}">
                    <label for="persona-realiza-analisis">Persona que realiza análisis</label>
                    <div class="form-group">
                        <select class="form-control filtros-administrativos" id="persona-realiza-analisis">
                            <option></option>
                            @foreach($personas_realizan_analisis as $persona_analiza)
                                <option {{ $filtros != null ? ($filtros != '[]' ? ($filtros['persona_realiza_analisis'] ==  $persona_analiza->id ? 'selected' : '' ) : '' ) : '' }} value="{{ $persona_analiza->id }}">{{ $persona_analiza->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            @endif
           
            <div class="row">
                @foreach($obras as $obra)
                    <div class="col-6">
                        <a href="{{ route('consulta.detalle', $obra->seo) }}">
                            <div class="service-block-detalle mb-2 mt-0">
                                <div class="row">
                                    <div class="col-4">
                                        @if ($obra->imagenes_principales->count())
                                            <img src="{{ asset('/img/obras/imagenes-principales/'.$obra->imagenes_principales->first()->imagen_chica) }}" alt="" class="img-fluid">
                                        @else
                                            <img src="img/predeterminadas/sin_imagen.png" alt="" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <div class="content">
                                            <h4 class="mt-2 mb-1 title-color">{{ $obra->nombre }}</h4>

                                            <span></span><br>
                                            <span><strong>Bien cultural:</strong> <small>{{ $obra->tipo_bien_cultural->nombre }}</small></span><br>
                                            <span><strong>Tipo objeto:</strong> <small>{{ $obra->tipo_objeto->nombre }}</small></span><br>

                                            @if ($obra->tipo_bien_cultural->calcular_temporalidad == "si")
                                                <span><strong>Temporalidad:</strong> <small>{{ $obra->temporalidad ? $obra->temporalidad->nombre : "N/A" }}</small></span><br>
                                            @else
                                                <span><strong>Año:</strong> <small>{{ $obra->año ? $obra->año->format('Y') : "N/A" }}</small></span><br>
                                                <span><strong>Época:</strong> <small>{{ $obra->epoca ? $obra->epoca->nombre : "SIN EPOCA" }}</small></span><br>
                                            @endif

                                            @if (!Auth::user()->rol->esExterno())
                                                <strong>Disponible para consulta:</strong> {!! $obra->disponible_consulta ? "<span class='texto-verde'>Si</span>" : "<span class='texto-rojo'>No</span>" !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                @if ($obras->count() == 0)
                    <h4 class="p-5">No hay obras que coincidan con la búsqueda.</h4>
                @endif
            </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {{ $obras->render() }}
                </div>
            </div>
        </div>
    </div>
@else
    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">En construcción</h3>

        <div class="error-desc">
            Esta sección aún se encuentra en construcción, estará accesible próximamente
        </div>
    </div>
@endif