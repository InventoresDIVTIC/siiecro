<div class="modal inmodal" id="modal-eliminar-interpretacion-cruzada" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    	<div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tipo Material | Interpretación Material</h4>
                <small class="font-bold">Eliminar Interpretación Material</small>
            </div>
            {!! Form::open(['route' => ['dashboard.obras-tipo-de-material.destruir-interpretacion-cruzada', $registro->id], 'method' => 'DELETE', 'id' => 'form-obras-tipo-de-material-eliminar-interpretacion-cruzada', 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
            	<div class="row">
            		<p>¿Estas seguro que deseas eliminar la Interpretación Material ?</p>
            	</div>

                <div class="row m-t-md" id="div-notificacion-interpretacion-cruzada">
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