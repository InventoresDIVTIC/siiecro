<div id="contenedor-esquema-analiticos-microfotografia">
	<div class="owl-carousel owl-theme" id="carrusel-esquema-analiticos-microfotografia">
	    @foreach ($imagenes_esquema_analiticos_microfotografia as $imagen)
	        <div class="item p-r-sm p-l-sm" id="resultados-analiticos-microfotografia">
	        	<a href="{{ asset('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$imagen->imagen) }}" {{ (stripos($imagen->imagen, '.pdf') ? 'target=_blank' : 'data-gallery=#galeria-resultados-analiticos-microfotografia') }} >
	            	<img class="img-responsive" src="{{ asset('img/'.( stripos($imagen->imagen, '.pdf') ? 'predeterminadas/imagen-pdf.png' : 'obras/resultados-analisis-esquema-analiticos-microfotografia/'.$imagen->imagen) ) }}" style="height: 150px; width: auto; margin: auto;">
	        	</a>
	            <i onclick="eliminarImagenEsquemaAnaliticosMicrofotografia({{ $imagen->id }}, {{ $imagen->analisis_a_realizar_resultado_id }})" class="fa fa-trash texto-rojo fa-lg icono-img" aria-hidden="true" data-placement="left" mi-tooltip="Eliminar"></i>
	        </div>
	    @endforeach
	</div>	
</div>