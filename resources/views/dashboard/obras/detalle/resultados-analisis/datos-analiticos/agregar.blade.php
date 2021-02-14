<div class="modal inmodal" id="modal-crear-resultado-analitico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Análisis a Realizar | Resultados</h4>
                <small class="font-bold">{{ $registro == "[]" ? "Creando nuevo resultado analítico" : "Editando resultado analítico" }} <strong>{{ $registro->tecnica }}</strong></small>
            </div>
            @if ($registro == "[]")
                {!! Form::open(['route' => ['dashboard.resultados-analisis.guardar-resultado-analitico'], 'method' => 'POST', 'id' => 'form-obras-detalle-crear-resultados-analiticos', 'class' => 'form-horizontal']) !!}
            @else
                {!! Form::open(['route' => ['dashboard.resultados-analisis.actualizar-resultado-analitico', $registro->id], 'method' => 'PUT', 'id' => 'form-obras-detalle-crear-resultados-analiticos', 'class' => 'form-horizontal']) !!}
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <div id="btn-group-habilitar-edicion-resultados-analiticos">
                            <button onclick="toggleEdicionDatosAnaliticos(true);" type="button" class="btn btn-primary pull-right" no-editar>Editar</button> 
                        </div>
                        <div id="btn-group-no-editar-resultados-analiticos" class="hidden">
                            <button onclick="toggleEdicionDatosAnaliticos(false);" type="button" class="btn btn-danger pull-right">Cancelar edición</button> 
                        </div>                    
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="informacion_por_definir_id">Información por definir</label>
                                <select class="form-control select2" id="informacion_por_definir_id" name="informacion_por_definir_id" required autocomplete="off" disabled="">
                                    <option value=""></option>
                                    @foreach ($tipos_material_informacion_por_definir as $informacion_por_definir)
                                        <option {{ $informacion_por_definir->id == $registro->informacion_por_definir_id ? "selected" : "" }} value="{{ $informacion_por_definir->id }}">{{ $informacion_por_definir->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 div-input required">
                                <label for="analisis_a_realizar_id">Análisis a realizar</label>
                                <select class="form-control select2" id="analisis_a_realizar_id" name="analisis_a_realizar_id" required disabled="" autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($analisis_a_realizar as $analisis)
                                        <option {{ $analisis->id == $registro->analisis_a_realizar_id ? "selected" : "" }} value="{{ $analisis->id }}">{{ $analisis->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 div-input required">
                                <label for="tecnica_analitica_id">Técnica analítica</label>
                                <select class="form-control select2" id="tecnica_analitica_id" name="tecnica_analitica_id" required disabled="" autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($analisis_a_realizar_tecnicas as $tecnica)
                                        <option {{ $tecnica->id == $registro->tecnica_analitica_id ? "selected" : "" }} value="{{ $tecnica->id }}">{{ $tecnica->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-12 div-input required">
                                <label for="interpretacion">Interpretacion</label>
                                <textarea class="form-control no-resize" name="interpretacion" id="interpretacion" rows="6" required disabled="" autocomplete="off" placeholder="Insertar el análisis y la interpretación de los datos (reacción, microfotografía, etc)"><?php echo($registro->interpretacion); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-6 div-input">
                                <label for="datos">Datos</label>
                                <input type="text" class="form-control" id="datos" name="datos" value="{{ $registro->datos }}" disabled="" autocomplete="off">
                            </div> --}}
                            <div class="col-md-12 div-input">
                                <label for="info_del_equipo">Información del equipo</label>
                                <input type="text" class="form-control" id="info_del_equipo" name="info_del_equipo" value="{{ $registro->info_del_equipo }}" disabled="" autocomplete="off">
                            </div>
                        </div>

                        @if ($registro != "[]")
                        <div class="row">
                            <div class="col-md-12 div-input hidden dropzones-imagenes">
                                <label for="dropzone-esquema-analiticos-microfotografia">Microfotografía, imagen o datos</label>
                                <div class="dropzone " id="dropzone-esquema-analiticos-microfotografia">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-md">
                            @include('dashboard.obras.detalle.resultados-analisis.datos-analiticos.esquema-analiticos-microfotografia.ver', ["imagenes_esquema_analiticos_microfotografia" => $registro->esquema_analiticos_microfotografias])
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 div-input">
                                <label for="ruta_acceso_imagen">Ruta de acceso a microfotografía, imagen o datos</label>
                                <input type="text" class="form-control" id="ruta_acceso_imagen" name="ruta_acceso_imagen" value="{{ $registro->ruta_acceso_imagen }}" disabled="" autocomplete="off" placeholder="Colocar ruta de acceso como lo indica el INST-04">
                            </div>
                            {{-- <div class="col-md-6 div-input">
                                <label for="ruta_acceso_datos">Ruta de acceso a datos</label>
                                <input type="text" class="form-control" id="ruta_acceso_datos" name="ruta_acceso_datos" value="{{ $registro->ruta_acceso_datos }}" disabled="" autocomplete="off">
                            </div> --}}
                        </div>
                    </div>


                    <div class="row m-t-md" id="div-notificacion-resultados-analiticos">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal" no-editar>Cerrar</button>
                    <button type="submit" class="btn btn-primary" disabled="">Guardar Cambios</button>
                </div>

                <input type="hidden" id="resultado_analisis_id" name="resultado_analisis_id" value="{{ $registro != "[]" ? $registro->resultado_analisis_id : ''}}">
            {!! Form::close() !!}
        </div>
    </div>
</div>