<div class="modal inmodal" id="modal-mis-datos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Mis datos</h4>
                <small class="font-bold">Editando mi información personal.</small>
            </div>
            {!! Form::open(['route' => ['dashboard.usuarios.mis-datos', Auth::user()->id], 'method' => 'PUT', 'id' => 'form-mis-datos', 'class' => 'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 div-input required">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" autocomplete="off" required>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" id="contraseña" name="contraseña" autocomplete="off" {{ Auth::user() == "[]" ? "required" : "" }}>
                            </div>
                            <div class="col-md-6 div-input">
                                <label for="repetir_contraseña">Repetir Contraseña</label>
                                <input type="password" class="form-control" id="repetir_contraseña" name="repetir_contraseña" autocomplete="off" {{ Auth::user() == "[]" ? "required" : "" }}>
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