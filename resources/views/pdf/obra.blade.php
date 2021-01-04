<html>
	<head>
	    {!!Html::style('css/pdf.css')!!}
	</head>
	<body>
		<header>
		    <img class="pull-left mt-sm" src="{{ asset('img/ecro.jpg') }}" height="50px">
		    <span class="pull-right fs-sm text-right">
		    	Generado por: {{ Auth::user()->name }}<br>
		    	{{ Carbon\Carbon::now() }}
		    </span>
		</header>

		<footer>
		    <span class="pagenum"></span>
		</footer>

		<main>
		    <div class="text-center">
		    	<span class="titulo">Datos de la obra: {{ $obra->folio }}</span><br>
		    </div>
		    <hr>
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Datos generales de identificación:</span><br>
			    	<strong>Titulo:</strong> {{ $obra->nombre }}<br>

			    	@if ($obra->tipo_bien_cultural->calcular_temporalidad == "si")
			    		<strong>Temporalidad:</strong> {{ $obra->temporalidad->nombre }}<br>
			    	@else
			    		<strong>Año de la obra:</strong> {{ $obra->año ? $obra->año->format('Y') : "N/A" }}<br>
			    		<strong>Época de la obra:</strong> {{ $obra->epoca->nombre }}<br>
			    	@endif
			    	
			    	<strong>Dimensiones:</strong> {{ $obra->alto }} cm x {{ $obra->ancho }} cm x {{ $oba->profundidad ?? 0 }} cm x {{ $obra->diametro ?? 0 }} cm<br>
			    	<strong>Tipo de bien cultural:</strong> {{ $obra->tipo_bien_cultural->nombre }}<br>
			    	<strong>Tipo de objeto:</strong> {{ $obra->tipo_objeto->nombre }}<br>
			    	<strong>Lugar de procedencia:</strong> {{ $obra->lugar_procedencia_original }}<br>
			    	<strong>Lugar de procedencia actual (ubicación o custodio):</strong> {{ $obra->lugar_procedencia_actual }}<br>
			    	<strong>No. de inventarios o códigos de procedencia:</strong> {{ $obra->numero_inventario }}
			    </div>
	    	</div>
		    <hr class="semi">
	    	<div class="col-100 mt-md">
			    <div class="text-left">
			    	<span class="subtitulo">Datos de identificación:</span><br>
			    	<strong>No. de registro de la obra:</strong> {{ $obra->folio }}<br>

			    	@if ($obra->proyecto)
				    	<strong>Proyecto ECRO:</strong> {{ $obra->proyecto->nombre }}<br>
				    	<strong>No. de proyecto ECRO:</strong> {{ $obra->proyecto->folio }}<br>
				    	<strong>Temporada del proyecto:</strong><br>
				    	@foreach ($obra->temporadas_trabajo_asignadas as $temporada)
					    	<div class="col-80">
					    		<div class="col-40 inline-block"></div>
					    		<div class="col-30 inline-block">{{ $temporada->año }}</div>
					    		<div class="col-30 inline-block">{{ $temporada->numero_temporada }}</div>
					    	</div>
				    	@endforeach
			    	@endif
			    </div>
	    	</div>
		    <hr class="semi">
	    	<div class="col-100 mt-md">
			    <div class="text-left">
			    	<strong>Forma de ingreso:</strong> {{ $obra->forma_ingreso }}<br>
			    	<strong>Área:</strong> {{ $obra->area->nombre }}<br>
			    	<strong>Responsables ECRO:</strong> {{ $obra->responsables_asignados->implode("name", ", ") }}<br>
			    	<strong>Caracteristicas descriptivas:</strong> {!! nl2br($obra->caracteristicas_descriptivas) !!}
			    </div>
	    	</div>
		    <hr class="semi">
	    	<div class="inline-block mt-md">
	    		<div class="col-50 inline-block">
	    			<strong>Disponible para consulta externa:</strong> Si/No
	    		</div>
	    		<div class="col-50 inline-block text-right">
	    			<strong>Fecha de entrada:</strong> {{ $obra->fecha_ingreso->format('d/m/Y') }} <br>
	    			<strong>Fecha de salida:</strong> {{ $obra->fecha_salida->format('d/m/Y') }}
	    		</div>
	    	</div>

		</main>
	</body>
</html>