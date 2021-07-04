@extends('layouts.landing')

@section('body')
    <div class="container mt-5" style="min-height: 80vh;">
        @if (Auth::check())
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2 class="mb-4">Consulta</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>Puedes realizar la consulta por cualquiera de estos 5 criterios.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col text-center pointer elemento-busqueda bg-rojo ml-2 mr-2" data-tipo-busqueda="Tipo objeto">
                    <div class="team-block">
                        <img src="{{ asset('img/landing/tipo_de_objeto.png') }}" alt=""  height="160px">

                        <div class="content">
                            <h4 class="mt-4 mb-0">Objeto</h4>
                            <p><i>Ejemplo: Escultura</i></p>
                        </div>
                    </div>
                </div>
                <div class="col text-center pointer elemento-busqueda bg-azul ml-2 mr-2" data-tipo-busqueda="Titulo">
                    <div class="team-block mb-5 mb-lg-0">
                        <img src="{{ asset('img/landing/titulo.png') }}" alt=""  height="160px">

                        <div class="content">
                            <h4 class="mt-4 mb-0">Titulo</h4>
                            <p><i>Ejemplo: Ecce Homo</i></p>
                        </div>
                    </div>
                </div>
                <div class="col text-center pointer elemento-busqueda bg-morado ml-2 mr-2" data-tipo-busqueda="Autor o cultura"> 
                    <div class="team-block mb-5 mb-lg-0">
                        <img src="{{ asset('img/landing/autor.png') }}" alt="" height="160px">

                        <div class="content">
                            <h4 class="mt-4 mb-0">Autor o cultura</h4>
                            <p><i>Ejemplo: Villalpando</i></p>
                        </div>
                    </div>
                </div>
                <div class="col text-center pointer elemento-busqueda bg-verde ml-2 mr-2" data-tipo-busqueda="Material">
                    <div class="team-block mb-5 mb-lg-0">
                        <img src="{{ asset('img/landing/material.png') }}" alt=""  height="160px">

                        <div class="content">
                            <h4 class="mt-4 mb-0">Material</h4>
                            <p><i>Ejemplo: Soporte</i></p>
                        </div>
                    </div>
                </div>
                <div class="col text-center pointer elemento-busqueda bg-amarillo ml-2 mr-2" data-tipo-busqueda="Técnica analítica">
                    <div class="team-block mb-5 mb-lg-0">
                        <img src="{{ asset('img/landing/tecnica_analitica.png') }}" alt=""  height="160px">

                        <div class="content">
                            <h4 class="mt-4 mb-0">Técnica analítica</h4>
                            <p><i>Ejemplo: Microscopio óptico</i></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 hidden" id="div-busqueda">
                <div class="sidebar-widget search  mb-3 w-100">
                    <h3>Ingresa el termino de busqueda para: <strong id="txt-busqueda"></strong></h3>
                    <div class="search-form">
                        <input id="input-busqueda" type="text" class="form-control" placeholder="Busqueda" autocomplete="off" onkeyup="buscar(event);">
                        <i class="icofont-ui-search"></i>
                    </div>
                </div>
            </div>

            <div class="row mt-2 mb-4 hidden" id="div-loading">
                <div class="col-12 text-center">
                    <h2 class="text-md">Buscando obras relacionadas</h2>
                    <br>
                    <h2><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></h2>

                </div>
            </div>

            <div id="div-resultados-busqueda">
            </div>
        @else
            <section class="contact-form-wrap section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title text-center">
                                <h2 class="text-md mb-2">Consulta</h2>
                                <div class="divider mx-auto my-4"></div>
                                <p class="mb-5">Para poder realizar la consulta en el sitio web es necesario ingresar con su usuario y contraseña, si no lo tiene por favor contactenos a traves de nuestro <a href="{{ route('contacto.index') }}">formulario de contacto</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <form id="contact-form" class="contact__form " method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Correo" required="" value="{{ old('email') }}">
                                        </div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required="">
                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input class="btn btn-main btn-round-full" name="submit" type="submit" value="Ingresar"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/landing/consulta.js') !!}
@endsection