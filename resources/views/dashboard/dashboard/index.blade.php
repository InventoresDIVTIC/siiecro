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
            <div class="col-sm-4">
                <canvas id="obras-bienes-culturales"></canvas>
            </div>
            <div class="col-sm-4">
                <canvas id="obras-areas"></canvas>
            </div>  
            <div class="col-sm-4">
                <canvas id="obras-tipos-objeto"></canvas>
            </div>
        </div>
    @endif

    <div class="row m-t-md">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <h2 class="text-center">Obras {{ Auth::user()->rol->acceso_a_datos_avanzado ? "recientes" : "asignadas" }}</h2>
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-obras">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-obras">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre</th>
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
                    <h2 class="text-center">Solicitudes de análisis {{ Auth::user()->rol->acceso_a_datos_avanzado ? "recientes" : "asignadas" }}</h2>
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-solicitudes">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-solicitudes">
                            <thead>
                                <tr>
                                    <th>Folio obra</th>
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
                    <h2 class="text-center">Resultados de análisis {{ Auth::user()->rol->acceso_a_datos_avanzado ? "recientes" : "asignadas" }}</h2>
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt-resultados">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-resultados">
                            <thead>
                                <tr>
                                    <th>Folio obra</th>
                                    <th>Fecha de análisis</th>
                                    <th>Nomenclatura</th>
                                    <th>Caracterización de materiales</th>
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