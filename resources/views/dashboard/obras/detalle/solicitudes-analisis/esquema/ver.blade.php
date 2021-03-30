<div id="contenedor-imagnes-esquema">
	<div class="owl-carousel owl-theme" id="carrusel-imagenes-esquema">
	    @foreach ($imagenes_esquema as $imagen)
	        <div class="item p-r-sm p-l-sm">
	        	<a href="{{ asset('img/obras/solicitudes-analisis-esquema/'.$imagen->imagen) }}" data-gallery="">
	            	<img class="img-responsive" src="{{ asset('img/obras/solicitudes-analisis-esquema/'.$imagen->imagen) }}" style="height: 150px; width: auto; margin: auto;">
	        	</a>
	            <i onclick="eliminarImagenEsquemaSolicitudAnalisis({{ $imagen->id }}, {{ $imagen->solicitud_analisis_id }})" class="fa fa-trash texto-rojo fa-lg icono-img" aria-hidden="true" data-placement="left" mi-tooltip="Eliminar"></i>
	        </div>
	    @endforeach
	</div>	
</div>
