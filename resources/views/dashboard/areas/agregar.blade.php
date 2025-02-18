<div class="modal inmodal" id="modal-crear" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Áreas</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Área" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.areas.store'], 'method' => 'POST', 'id' => 'form-areas', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.areas.update', $registro->id], 'method' => 'PUT', 'id' => 'form-areas', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8 div-input required">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $registro->nombre }}" onchange="generarSiglas();" required autocomplete="off">
                            </div>
                            <div class="col-md-4 div-input required">
                                <label for="siglas">Siglas</label>
                                <input type="text" class="form-control" id="siglas" name="siglas" value="{{ $registro->siglas }}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="nombre">Color</label>
                                <input type="text" class="form-control" id="color_hexadecimal" name="color_hexadecimal" value="{{ $registro->color_hexadecimal }}" required autocomplete="off">
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
        </div>
    </div>
</div>