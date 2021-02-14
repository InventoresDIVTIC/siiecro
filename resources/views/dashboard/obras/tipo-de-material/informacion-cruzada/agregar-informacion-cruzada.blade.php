<div class="modal inmodal" id="modal-crear-informacion-cruzada" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras | Tipo Material | Información Por Definir</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nueva Información por definir" : "Editando a " }} <strong>{{ $registro->nombre }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.obras-tipo-de-material.guardar-informacion-cruzada'], 'method' => 'POST', 'id' => 'form-obras-tipo-de-material-informacion-cruzada', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.obras-tipo-de-material.actualizar-informacion-cruzada', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-tipo-de-material-informacion-cruzada', 'class' => 'form-horizontal']) !!}
            @endif
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 div-input required">
                            <label for="informacion_por_definir_cruzada_id">Información Por Definir</label>
                            <select class="form-control select2" id="informacion_por_definir_cruzada_id" name="informacion_por_definir_cruzada_id" required autocomplete="off">
                                <option value=""></option>
                                @foreach($informaciones as $informacion)
                                    <option {{ $informacion->id == $registro->informacion_por_definir_cruzada_id ? 'selected' : '' }} value="{{ $informacion->id }}">{{ $informacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row m-t-md" id="div-notificacion-informacion-cruzada">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <input type="hidden" name="tipo_material_cruzada_info_id" id="tipo_material_cruzada_info_id" value="">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>