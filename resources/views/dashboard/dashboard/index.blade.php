@extends('layouts.dashboard', ['menu' => "dashboard"])

@section('top-body')
	<div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Dashboard</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
    </div>
@endsection

@section('body')
    @if (Auth::user()->rol->acceso_a_datos_avanzado)
        <div class="row">
            <div class="col-12 carousel-wrap">
                <div class="owl-carousel  owl-theme" id="carrusel-graficas">
                    <div class="item">
                        <canvas id="obras-bienes-culturales"></canvas>
                    </div>
                    <div class="item">
                        <canvas id="obras-areas"></canvas>
                    </div>
                    <div class="item">
                        <canvas id="obras-tipos-objeto"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Obras registradas en el sistema.</h5>
                        <small class="pull-right"><strong>{{ $objTotalesObras->total_mes }}</strong> en {{ Date::now()->format('F') }}.</small>
                    </div>
                    <div class="ibox-content text-center">
                        <h1 class="no-margins">{{ $objTotalesObras->total }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Obras disponibles en consulta.</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <h1 class="no-margins">{{ $objTotalesObras->total_disponible }} / {{ $objTotalesObras->total_no_disponible }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Obras por tipo.</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <h1 class="no-margins">{{ $objTotalesObras->total_interno }} / {{ $objTotalesObras->total_externo }}</h1>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row m-t-md">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2 class="text-center">Obras {{ Auth::user()->rol->acceso_a_lista_solicitudes_obras ? "recientes" : "asignadas" }}</h2>
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-obras">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-obras">
                            <thead>
                                <tr>
                                    <th>No registro</th>
                                    <th>Titulo</th>
                                    <th>Área</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2 class="text-center">Solicitudes de análisis {{ Auth::user()->rol->acceso_a_lista_solicitudes_analisis ? "recientes" : "asignadas" }}</h2>
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-solicitudes">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-solicitudes">
                            <thead>
                                <tr>
                                    <th>No. registro obra</th>
                                    <th>Fecha de intervención</th>
                                    <th>Temporada de trabajo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2 class="text-center">Resultados de análisis {{ Auth::user()->rol->acceso_a_lista_solicitudes_analisis ? "recientes" : "asignadas" }}</h2>
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-resultados">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-resultados">
                            <thead>
                                <tr>
                                    <th>No. registro obra</th>
                                    <th>Fecha de análisis</th>
                                    <th>Nomenclatura</th>
                                    <th>Asesor científico</th>
                                    <th>Persona realizó análisis</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/dashboard.js') !!}
@endsection