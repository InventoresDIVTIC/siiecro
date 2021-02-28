@extends('layouts.landing')

@section('body')
    <div class="container mt-5" style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    <h2 class="mb-4">Consulta</h2>
                    <div class="divider mx-auto my-4"></div>
                    <p>Puedes realizar la consulta por cualquiera de estos 4 criterios.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Tipo objeto">
                <div class="team-block">
                    <img src="{{ asset('img/landing/tipo_de_objeto.png') }}" alt=""  height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Objeto</h4>
                        <p><i>Ejemplo: Escultura</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Autor o cultura"> 
                <div class="team-block mb-5 mb-lg-0">
                    <img src="{{ asset('img/landing/autor.png') }}" alt="" height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Autor o cultura</h4>
                        <p><i>Ejemplo: Villalpando</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Material">
                <div class="team-block mb-5 mb-lg-0">
                    <img src="{{ asset('img/landing/material.png') }}" alt=""  height="160px">

                    <div class="content">
                        <h4 class="mt-4 mb-0">Material</h4>
                        <p><i>Ejemplo: Soporte</i></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 text-center pointer elemento-busqueda" data-tipo-busqueda="Técnica analítica">
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
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/landing/consulta.js') !!}
@endsection