<div class="modal inmodal" id="modal-habilitar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Obras</h4>
                <small class="font-bold">Habilitar Obra</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras.update', $registro->id], 'method' => 'PUT', 'id' => 'form-habilitar', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas habilitar la Obra <strong>{{ $registro->nombre }}</strong>?</p>
            	</div>

                <div class="row m-t-md" id="div-notificacion">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Habilitar</button>
            </div>
            <input type="hidden" name="status_operativo" value="Habilitado">
            {!! Form::close() !!}
        </div>
    </div>
</div>