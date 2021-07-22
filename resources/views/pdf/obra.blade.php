<html>
	<head>
	    {!!Html::style('css/pdf.css')!!}
	</head>
	<body>
		<header>
		    <img class="pull-left mt-sm" src="{{ asset('img/ecro.jpg') }}" height="50px">
		    <span class="pull-right fs-6 text-right">
		    	Generado por: {{ Auth::user()->name }}<br>
		    	<strong>{{ Carbon\Carbon::now() }}</strong>
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
			    		<strong>Temporalidad:</strong> {{ $obra->temporalidad ? $obra->temporalidad->nombre : "N/A" }}<br>
			    	@else
			    		<strong>Año de la obra:</strong> {{ $obra->año ? $obra->año->format('Y') : "N/A" }}<br>
			    		<strong>Época de la obra:</strong> {{ $obra->epoca->nombre }}<br>
			    	@endif
			    	
			    	<strong>Dimensiones:</strong> {{ $obra->etiquetaDimensiones() }}<br>
			    	<strong>Tipo de bien cultural:</strong> {{ $obra->tipo_bien_cultural->nombre }}<br>
			    	<strong>Tipo de objeto:</strong> {{ $obra->tipo_objeto->nombre }}<br>
			    	<strong>Lugar de procedencia:</strong> {{ $obra->lugar_procedencia_original }}<br>
			    	<strong>Lugar de procedencia actual (ubicación o custodio):</strong> {{ $obra->lugar_procedencia_actual }}<br>
			    	@if (Auth::user()->rol->acceso_a_datos_avanzado)
			    		<strong>No. de inventarios o códigos de procedencia:</strong> {{ $obra->numero_inventario }}
			    	@endif
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
			    	@if (Auth::user()->rol->acceso_a_datos_avanzado)
			    		<strong>Forma de ingreso:</strong> {{ $obra->forma_ingreso }}<br>
			    	@endif
			    	<strong>Área:</strong> {{ $obra->area ? $obra->area->nombre : "Sin asignar" }}<br>
			    	<strong>Responsables ECRO:</strong> {{ $obra->responsables_asignados->implode("name", ", ") }}<br>
			    	@if (Auth::user()->rol->acceso_a_datos_avanzado)
			    		<strong>Caracteristicas descriptivas:</strong> {!! nl2br($obra->caracteristicas_descriptivas) !!}
			    	@endif
			    </div>
	    	</div>
		    <hr class="semi">
	    	<div class="inline-block mt-md">
	    		<div class="col-50 inline-block">
	    			<strong>Disponible para consulta externa:</strong> {{ $obra->disponible_consulta ? "Si" : "No" }}
	    		</div>
	    		@if (Auth::user()->rol->acceso_a_datos_avanzado)
		    		<div class="col-50 inline-block text-right">
		    			<strong>Fecha de entrada:</strong> {{ $obra->fecha_ingreso ? $obra->fecha_ingreso->format('d/m/Y') : "N/A" }} <br>
		    			<strong>Fecha de salida:</strong> {{ $obra->fecha_salida ? $obra->fecha_salida->format('d/m/Y') : "N/A" }}
		    		</div>
	    		@endif
	    	</div>

		</main>
	</body>
</html>