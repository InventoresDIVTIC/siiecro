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
                            <h5 class="mt-3 mb-3">Datos de la obra / pieza / conjunto</h5>
                            <hr>
                            <span>
                                <strong>Titulo:</strong> {{ $obra->nombre }}
                            </span><br>
                            <span>
                                <strong>Autor o Cultura:</strong> {{ $obra->autor ?? $obra->cultura }}
                            </span><br>
                            <span>
                                <strong>Año / Época o Temproalidad:</strong> {{ $obra->tipo_bien_cultural->nombre }}
                            </span><br>
                            <span>
                                <strong>Técnica:</strong> Tecnica
                            </span><br>
                            <span>
                                <strong>Dimensiones:</strong> {{ $obra->cadenaDimensiones() }}
                            </span><br>
                            <span>
                                <strong>Tipo de bien cultural:</strong> {{ $obra->tipo_bien_cultural->nombre }}
                            </span><br>
                            <span>
                                <strong>Tipo de objeto:</strong> {{ $obra->tipo_objeto->nombre }}
                            </span><br>
                            <span>
                                <strong>Lugar de procedencia original:</strong> {{ $obra->lugar_procedencia_original }}
                            </span><br>
                            <span>
                                <strong>Lugar de procedencia actual:</strong> {{ $obra->lugar_procedencia_actual }}
                            </span><br>
                            <span>
                                <strong>No. de inventario o código de procedencia:</strong> {{ $obra->numero_inventario }}
                            </span><br>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <span>
                                        <strong>No. de Registro de obra:</strong>
                                        <small>{{ $obra->folio }}</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>Proyecto ECRO:</strong>
                                        <small>Proyecto</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>No. de Proyecto ECRO:</strong>
                                        <small>No de proyecto</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>No de temporada de trabajo:</strong>
                                        <small>{{ $obra->tipo_bien_cultural->nombre }}</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>Año del proyecto:</strong>
                                        <small>{{ $obra->tipo_bien_cultural->nombre }}</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>Forma de ingreso:</strong>
                                        <small>{{ $obra->forma_ingreso }}</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>Sector:</strong>
                                        <small>SECTOR?</small>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span>
                                        <strong>Responsables ECRO:</strong>
                                        <small>{{ $obra->tipo_bien_cultural->nombre }}</small>
                                    </span>
                                </div>
                                <div class="col-12">
                                    <span>
                                        <strong>Caracteristicas descriptivas:</strong><br>
                                        <small>{{ nl2br($obra->caracteristicas_descriptivas) }}</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div id="acordeon">
                                <div class="card">
                                    <div class="card-header">
                                      <a class="card-link" data-toggle="collapse" href="#registro-fotografico">
                                        Registro fotográfico
                                      </a>
                                    </div>
                                    <div id="registro-fotografico" class="collapse show" data-parent="#acordeon">
                                      <div class="card-body">
                                        Contenido Registro fotográfico
                                      </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#analisis-cientificos">
                                            Análisis científicos
                                        </a>
                                    </div>
                                    <div id="analisis-cientificos" class="collapse" data-parent="#acordeon">
                                        <div class="card-body">
                                            Contenido Análisis científicos
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#informes-intervencion">
                                            Informes de intervención
                                        </a>
                                    </div>
                                    <div id="informes-intervencion" class="collapse" data-parent="#acordeon">
                                        <div class="card-body">
                                            Contenido Informes de intervención
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


        <div class="mb-5 hidden" id="div-obras-recomendadas">
            <h3 class="font-weight-normal">Te recomendamos visitar:</h3>

            <div id="respuesta-obras-recomendadas">
                <h3 class="text-center">
                    Buscando obras recomendadas <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
                </h3>
            </div>
        </div>
    </div>
    <input type="hidden" id="obra_id" value="{{ $obra->id }}">
@endsection

@section('scripts')
    {!! Html::script('scripts/landing/detalle.js') !!}
@endsection