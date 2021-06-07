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
		    	<span class="titulo">Solicitud de análisis científico</span><br>
		    </div>
		    <hr>
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Datos generales de la obra:</span><br>
			    	<strong>No. de registro de la obra:</strong> {{ $solicitudAnalisis->obra->folio }}<br>
			    	<strong>Área de la obra:</strong> {{ $solicitudAnalisis->obra->area->nombre }}<br>
			    	<strong>Titulo de la obra:</strong> {{ $solicitudAnalisis->obra->nombre }}<br>

			    	@if ($solicitudAnalisis->obra->tipo_bien_cultural->calcular_temporalidad == "si")
			    		<strong>Temporalidad:</strong> {{ $solicitudAnalisis->obra->temporalidad ? $solicitudAnalisis->obra->temporalidad->nombre : "N/A" }}<br>
			    	@else
			    		<strong>Año de la obra:</strong> {{ $solicitudAnalisis->obra->año ? $solicitudAnalisis->obra->año->format('Y') : "N/A" }}<br>
			    		<strong>Época de la obra:</strong> {{ $solicitudAnalisis->obra->epoca->nombre }}<br>
			    	@endif
			    	
			    	<strong>Tipo de objeto:</strong> {{ $solicitudAnalisis->obra->tipo_objeto->nombre }}<br>
			    	<strong>Tecnica:</strong> {{ $solicitudAnalisis->obra->tipo_objeto->nombre }}<br>
			    	<strong>Dimensiones:</strong> {{ $solicitudAnalisis->obra->alto }} cm x {{ $solicitudAnalisis->obra->ancho }} cm x {{ $oba->profundidad ?? 0 }} cm x {{ $solicitudAnalisis->obra->diametro ?? 0 }} cm<br>
			    	<strong>Año de la temporada de trabajo:</strong> {{ $solicitudAnalisis->obra_temporada_trabajo->temporada_trabajo->año }}<br>
			    	<strong>Temporada de trabajo:</strong> {{ $solicitudAnalisis->obra_temporada_trabajo->temporada_trabajo->numero_temporada }}<br>
			    	<strong>Responsable de intervención:</strong> {{ $solicitudAnalisis->reponsable_solicitud->usuario->name }}<br>
			    	<strong>Fecha de inicio de intervención:</strong> {{ $solicitudAnalisis->fecha_intervencion }}<br>
			    	
			    </div>
	    	</div>
		    <hr class="semi">
	    	<div class="col-100">
			    <div class="text-left">
			    	<span class="subtitulo">Esquema de ubicación de toma de muestras:</span><br>
			    	@foreach ($solicitudAnalisis->imagenes_esquema as $imagen)
			    		<div class="mt-md text-center">
			    			<img src="{{ asset('/img/obras/solicitudes-analisis-esquema/'.$imagen->imagen) }}" width="50%">
			    		</div>
			    	@endforeach
			    </div>
	    	</div>
		    <hr class="semi mt-md">
	    	<div class="col-100">
			    <div class="text-left">
			    	<span class="subtitulo">Ánalisis:</span><br>

			    	@foreach ($muestras as $nombre => $muestrasPorTipo)
			    		<br>
			    		<span class="subtitulo mt-md fs-16">{{ $nombre }}</span>
				    	<table>
				    		<thead style="background-color: {{ $muestrasPorTipo->first()->color }}; color: white;">
					    		<tr>
						    		<th class="col-10 fs-12">No. de muestra</th>
						    		<th class="col-10 fs-12">Nomenclatura</th>
						    		<th class="col-20 fs-12">Información requerida (¿Qué?)</th>
						    		<th class="col-20 fs-12">Motivo (¿Para qué?)</th>
						    		<th class="col-20 fs-12">Descripción muestra</th>
						    		<th class="col-20 fs-12">Ubicación</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    		@foreach ($muestrasPorTipo as $muestra)
						    		<tr>
						    			<td class="fs-12">{{ $muestra->no_muestra }}</td>
						    			<td class="fs-12">{{ $muestra->nomenclatura }}</td>
						    			<td class="fs-12">{{ nl2br($muestra->informacion_requerida) }}</td>
						    			<td class="fs-12">{{ nl2br($muestra->motivo) }}</td>
						    			<td class="fs-12">{{ nl2br($muestra->descripcion_muestra) }}</td>
						    			<td class="fs-12">{{ $muestra->ubicacion }}</td>
						    		</tr>
					    		@endforeach
					    	</tbody>
				    	</table>
			    	@endforeach
			    </div>
	    	</div>

		</main>
	</body>
</html>