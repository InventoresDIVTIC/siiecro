<div class="modal inmodal" id="modal-crear" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras | Interpretación Material</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Interpretación Material" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras-interpretacion-particular.store'], 'method' => 'POST', 'id' => 'form-obras-interpretacion-particular', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras-interpretacion-particular.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-interpretacion-particular', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" required autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-md" id="div-notificacion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            {!! Form::close() !!}

            @if ($registro != "[]")
            <hr>
            <h1 class="text-center"><strong>Tesauros</strong></h1>
            <br>
            <div class="row ibox">
                <div class="col-md-12">
                    <button type="button" onclick="crearTerminoRelacionado({{ $registro->id }})" class="btn btn-primary pull-right">Agregar término relacionado</button>
                </div>
            </div>
            {{-- tabla de terminos relacionados --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="progress hidden" id="carga-dt-terminos-relacionados">
                                <div class="progress-bar-indeterminate"></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="dt-datos-terminos-relacionados">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
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
            <input type="hidden" id="id_interpretacion_particular" name="id_interpretacion_particular" value="{{ $registro != '[]' ? $registro->id : '' }}">
            @endif

        </div>
    </div>
</div>