<div class="modal inmodal" id="modal-crear-interpretacion-cruzada" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras | Tipo Material | Interpretación Paricular</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Técnica" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras-tipo-de-material.guardar-interpretacion-cruzada'], 'method' => 'POST', 'id' => 'form-obras-tipo-de-material-interpretacion-cruzada', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras-tipo-de-material.actualizar-interpretacion-cruzada', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-tipo-de-material-interpretacion-cruzada', 'class' => 'form-horizontal']) !!}
            @endif
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 div-input required">
                            <label for="interpretacion_particular_cruzada_id">Interpretación particular</label>
                            <select class="form-control select2" id="interpretacion_particular_cruzada_id" name="interpretacion_particular_cruzada_id" required autocomplete="off">
                                <option value=""></option>
                                @foreach($interpretaciones as $interpretacion)
                                    <option {{ $interpretacion->id == $registro->interpretacion_particular_cruzada_id ? 'selected' : '' }} value="{{ $interpretacion->id }}">{{ $interpretacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row m-t-md" id="div-notificacion-interpretacion-cruzada">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <input type="hidden" name="tipo_material_cruzada_iter_id" id="tipo_material_cruzada_iter_id" value="">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>