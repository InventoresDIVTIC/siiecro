<div class="modal inmodal" id="modal-eliminar-terminos-relacionados" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tipo objeto | Término relacionado</h4>
                <small class="font-bold">Eliminar Término relacionado</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras-tipo-objeto.destruir-terminos-relacionados', $registro->id], 'method' => 'DELETE', 'id' => 'form-obras-tipo-objeto-terminos-relacionados', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
                <div class="row">
                    <p>¿Estas seguro que deseas eliminar el Término relacionado <strong>{{ $registro->nombre }}</strong>?</p>
                </div>

                <div class="row m-t-md" id="div-notificacion-eliminar-terminos-relacionados">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>