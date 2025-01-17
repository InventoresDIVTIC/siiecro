<div id="contenedor-esquema-muestra">
	<div class="owl-carousel owl-theme" id="carrusel-esquema-muestra">
	    @foreach ($esquema_muestra as $imagen)
	        <div class="item p-r-sm p-l-sm" id="resultados-esquema-toma-muestras">
	        	<a href="{{ asset('img/obras/resultados-analisis-esquema-muestra/'.$imagen->imagen) }}" data-gallery="#galeria-resultados-esquema-toma-muestras">
	            	<img class="img-responsive" src="{{ asset('img/obras/resultados-analisis-esquema-muestra/'.$imagen->imagen) }}" style="height: 150px; width: auto; margin: auto;">
	        	</a>
	            <i onclick="eliminarImagenEsquemaResultadoAnalisisMuestra({{ $imagen->id }}, {{ $imagen->resultado_analisis_id }})" class="fa fa-trash texto-rojo fa-lg icono-img" aria-hidden="true" data-placement="left" mi-tooltip="Eliminar"></i>
	        </div>
	    @endforeach
	</div>	
</div>