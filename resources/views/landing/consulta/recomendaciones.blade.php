@if ($obras->count())
	<div class="owl-carousel mt-4" id="carrusel-recomendaciones">
		@foreach ($obras as $obra)
			<div class="item">
				<a href="{{ route('consulta.detalle', $obra->seo) }}">
					<div class="team-block">
						<div style="height: 250px;">
							<img src="{{ asset('img/predeterminadas/sin_imagen.png') }}" style="height: auto; width: 100%;">
						</div>

	                    <div class="content">
	                        <h4>{{ $obra->nombre }}</h4>
	                        <span><strong>Bien cultural:</strong> <small>{{ $obra->tipo_bien_cultural->nombre }}</small></span><br>
	                        <span><strong>Tipo objeto:</strong> <small>{{ $obra->tipo_objeto->nombre }}</small></span><br>

	                        @if ($obra->tipo_bien_cultural->calcular_temporalidad == "si")
	                        	<span><strong>Temporalidad:</strong> <small>{{ $obra->temporalidad ? $obra->temporalidad->nombre : "N/A" }}</small></span>
	                        @else
		                        <span><strong>Año:</strong> <small>{{ $obra->año ? $obra->año->format('Y') : "N/A" }}</small></span><br>
		                        <span><strong>Época:</strong> <small>{{ $obra->epoca->nombre }}</small></span><br>
	                        @endif
	                    </div>
	                </div>
                </a>
			</div>
		@endforeach
	</div>
@else
	<h4>Lo siento, no hay ninguna obra que te podamos recomendar</h4>
@endif