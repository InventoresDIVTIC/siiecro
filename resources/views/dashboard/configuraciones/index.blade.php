@extends('layouts.dashboard', ['menu' => "configuraciones"])

@section('top-body')
    {!! Form::open(['route' => ['dashboard.configuraciones.update', $configuracion->id], 'method' => 'PUT', 'id' => 'form-configuracion', 'class' => 'form-horizontal']) !!}
        <div class="col-sm-4">
            <h2>Parametros de configuración del sistema</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Configuraciones</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
@endsection

@section('body')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-12 p-md" id="div-notificacion"></div>
                        </div>
                        <div class="row m-t-md">
                            <div class="col-md-6 col-sm-12 div-input required">
                                <label for="director_general">Director general</label>
                                <input type="text" class="form-control" id="director_general" name="director_general" value="{{ $configuracion->director_general }}" required autocomplete="off">
                            </div>
                            <div class="col-md-6 col-sm-12 div-input required">
                                <label for="director_academico">Director académico</label>
                                <input type="text" class="form-control" id="director_academico" name="director_academico" value="{{ $configuracion->director_academico }}" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('scripts')
    {!! Html::script('scripts/dashboard/configuraciones.js') !!}
@endsection