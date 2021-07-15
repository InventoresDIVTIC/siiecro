<div class="modal inmodal" id="modal-crear-terminos-relacionados" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Interpretación Material | Término relacionado</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nuevo término relacionado" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras-interpretacion-particular.guardar-terminos-relacionados'], 'method' => 'POST', 'id' => 'form-obras-interpretacion-particular-terminos-relacionados', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras-interpretacion-particular.actualizar-terminos-relacionados', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-interpretacion-particular-terminos-relacionados', 'class' => 'form-horizontal']) !!}
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

                <div class="row m-t-md" id="div-notificacion-terminos-relacionados">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <input type="hidden" name="tipo_material_interpretacion_particular_id" id="tipo_material_interpretacion_particular_id" value="">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>