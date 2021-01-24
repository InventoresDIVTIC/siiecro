<div class="modal inmodal" id="modal-ver-muestras" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" {{-- style="width: 1000px;" --}}>
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Solicitud de análisis</h4>

                <h1>Obra <strong><span id="nombre_obra_solicitud"></span></strong> - Folio <strong><span id="folio_obra_solicitud"></span></strong></h1>
            </div>
            <div class="modal-body">
                @if ($registro == "[]")
                    {!! Form::open(['route' => ['dashboard.solicitudes-analisis.store'], 'method' => 'POST', 'id' => 'form-obras-detalle-solicitudes-analisis', 'class' => 'form-horizontal']) !!}
                @else
                    {!! Form::open(['route' => ['dashboard.solicitudes-analisis.update', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-detalle-solicitudes-analisis', 'class' => 'form-horizontal']) !!}
                @endif
                <div class="form-group">
                    <div id="btn-group-habilitar-edicion-analisis">
                        <button onclick="toggleEdicionSolicitudesAnalisis(true);" type="button" class="btn btn-primary pull-right" no-editar>Editar</button> 
                    </div>
                    <div id="btn-group-no-editar-analisis" class="hidden">
                        <button onclick="toggleEdicionSolicitudesAnalisis(false);" type="button" class="btn btn-danger pull-right" no-editar>Cancelar edición</button> 
                    </div>                    
                </div>

                <hr>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 div-input">
                            <label for="tecnica">Técnica</label>
                            <input type="text" class="form-control" id="tecnica" name="tecnica" value="{{ $registro->tecnica }}" disabled="" autocomplete="off">
                        </div>
                        <div class="col-md-6 div-input">
                            <label for="fecha_intervencion">Fecha de intervención</label>
                            <input type="text" class="form-control" id="fecha_intervencion" name="fecha_intervencion" value="{{ $registro->fecha_intervencion }}" disabled="" autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 div-input required">
                            <label for="obra_usuario_asignado_id">Responsable</label>
                            <select class="form-control select2" id="obra_usuario_asignado_id" name="obra_usuario_asignado_id" disabled="" required autocomplete="off">
                                <option value=""></option>
                                @foreach ($responsables_intervencion as $responsable_intervencion)
                                    <option {{ $responsable_intervencion->id == $registro->obra_usuario_asignado_id ? "selected" : "" }} value="{{ $responsable_intervencion->id }}">{{ $responsable_intervencion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 div-input required">
                            <label for="obra_temporada_trabajo_asignada_id">Temporada trabajo</label>
                            <select class="form-control select2" id="obra_temporada_trabajo_asignada_id" name="obra_temporada_trabajo_asignada_id" disabled="" required autocomplete="off">
                                <option value=""></option>
                                @foreach ($temporadasTrabajoAsignadas as $temporadaTrabajoAsignada)
                                    <option {{ $temporadaTrabajoAsignada->id == $registro->obra_temporada_trabajo_asignada_id ? "selected" : "" }} value="{{ $temporadaTrabajoAsignada->id }}">{{ $temporadaTrabajoAsignada->temporada_trabajo->numero_temporada }} [{{ $temporadaTrabajoAsignada->temporada_trabajo->año }}]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($registro != "[]")
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="dropzone-solicitud-analisis">Esquema</label>
                                <div class="dropzone " id="dropzone-solicitud-analisis">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row m-t-md">
                        @include('dashboard.obras.detalle.solicitudes-analisis.esquema.ver', ["imagenes_esquema" => $registro->imagenes_esquema])
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" disabled="">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
                {{-- <br> --}}
                {!! Form::close() !!}

                <div class="form-group">
                    <hr>
                    <h1 class="text-center">
                        <strong>Muestras</strong>
                    </h1>
                    <div class="progress hidden" id="carga-dt-solicitudes-analisis-muestras">
                        <div class="progress-bar-indeterminate"></div>
                    </div>

                    <div class="row ibox">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" onclick="crearMuestra({{ $registro->id }})" class="btn btn-primary pull-right" no-editar>Agregar muestra</button>
                            </div>                        
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed" id="dt-datos-solicitudes-analisis-muestras">
                            <thead>
                                <tr>
                                    <th>Caracterización materiales</th>
                                    <th>No Muestra</th>
                                    <th>Nomenclatura</th>
                                    <th>Información Requerida</th>
                                    <th>Motivo</th>
                                    <th>Descripción de la Muestra</th>
                                    <th>Ubicación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row m-t-md" id="div-notificacion">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id_de_solicitud" value="{{ $registro->id != "[]" ? $registro->id : ''}}">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>