<div class="row mt-5">
    <div class="col-lg-3 hid den">
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
    </div>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Área</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Responsable ECRO</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Proyecto ECRO</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="">
                      <option>Año de la temporada de trabajo</option>
                    </select>
                </div>
            </div>
        </div>
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
    </div>
</div>