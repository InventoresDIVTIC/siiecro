 {{-- @if (Auth::user()->rol->consulta_general_avanzada) --}}
    <div class="row mt-5">
        {{-- <div class="col-lg-3 hid den">
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Año</h5>

                    <div class="form-group">
                        <select class="form-control" id="">
                          <option>2007</option>
                          <option>2008</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Época</h5>

                    <div class="form-group">
                        <select class="form-control" id="">
                          <option>Siglo XXI</option>
                          <option>Siglo XX</option>
                          <option>Siglo XIX</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Temporalidad</h5>

                    <div class="form-group">
                        <select class="form-control" id="">
                          <option>Desconocida</option>
                          <option>Clásico temprano (0-300 d.C)</option>
                          <option>Preclásico medio</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Autor o Cultura</h5>

                    <div class="form-group">
                        <select class="form-control" id="">
                          <option>Mario Rosilio</option>
                          <option>Tamara de Lempicka</option>
                          <option>Capacha, Occidente de México</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Lugar de procedencia actual</h5>

                    <div class="form-group">
                        <select class="form-control" id="">
                          <option>Museo de Mascota</option>
                          <option>Museo Regional de Guadalajara</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget category mb-2 pb-0">
                    <h5 class="mb-2">Lugar de procedencia original</h5>

                    <div class="form-group">
                        <select class="form-control" id="">
                          <option>Desconocido</option>
                          <option>"El Panteon" Mascota, Jalisco</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget tags mb-2 pb-0">
                    <h5 class="mb-2">Tipo de bien cultural</h5>

                    <a href="#">Etnográfico</a>
                    <a href="#">Industrial</a>
                    <a href="#">Religioso</a>
                    <a href="#">Artístico</a>
                    <a href="#">Histórico</a>
                </div>
            </div>
            <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                <div class="sidebar-widget tags mb-2 pb-0">
                    <h5 class="mb-2">Materiales</h5>

                    <a href="#">Sal</a>
                    <a href="#">Adhesivo</a>
                    <a href="#">Capas de superficie </a>
                    <a href="#">Aglutinante</a>
                    <a href="#">Colorante</a>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-12">
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
                <div class="col-3">
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
                <div class="col-3">
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
            
            <div class="row">
                {{-- <h4 class="p-5">OBRAS ENCONTRADAS {{ $obras->count() }}</h4> --}}
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
        </div>
    </div>
{{-- 
@else
    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">En construcción</h3>

        <div class="error-desc">
            Esta sección aún se encuentra en construcción, estará accesible próximamente
        </div>
    </div>
@endif
--}}