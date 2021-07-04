@extends('layouts.dashboard', ['menu' => "obras"])

@section('top-body')
    <div class="col-sm-4">
        <h2>Administración de Obras</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Obras</strong>
            </li>
        </ol>
    </div>
    
    @if (Auth::user()->rol->edicion_de_registro_avanzada_2)
        <div class="col-sm-8">
            <div class="btn-group m-t-md pull-right">
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Exportar / importar <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('dashboard.obras.exportar', 1) }}">Exportar</a></li>
                    <li><a href="{{ route('dashboard.obras.exportar', 0) }}" class="font-bold">Exportar traducido</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:importarObras();">Importar</a></li>
                </ul>
            </div>
        </div>
    @endif
@endsection

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce" id="carga-dt">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dt-datos">
                            <thead>
                                <tr>
                                    <th>No registro</th>
                                    <th>Titulo</th>
                                    <th>Tipo bien cultural</th>
                                    <th>Tipo de objeto</th>
                                    <th>Año</th>
                                    <th>Época</th>
                                    <th>Temporalidad</th>
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
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/obras/obras.js') !!}
@endsection