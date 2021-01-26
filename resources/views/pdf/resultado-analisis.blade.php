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
		    	<span class="titulo">Registro de resultados de análisis</span><br>
		    </div>
		    <hr>
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Datos generales de la obra:</span><br>
			    	<strong>No. de registro de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->folio }}<br>
			    	<strong>Área de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->area->nombre }}<br>
			    	<strong>Titulo de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->nombre }}<br>

			    	@if ($resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->tipo_bien_cultural->calcular_temporalidad == "si")
			    		<strong>Temporalidad:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->temporalidad->nombre }}<br>
			    	@else
			    		<strong>Año de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->año ? $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->año->format('Y') : "N/A" }}<br>
			    		<strong>Época de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->epoca->nombre }}<br>
			    	@endif
			    	
			    	<strong>Tipo de objeto:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->tipo_objeto->nombre }}<br>
			    	<strong>Tecnica:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->tipo_objeto->nombre }}<br>
			    	<strong>Dimensiones:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->alto }} cm x {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->ancho }} cm x {{ $oba->profundidad ?? 0 }} cm x {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->diametro ?? 0 }} cm<br>
			    	<strong>Año de la temporada de trabajo:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra_temporada_trabajo->temporada_trabajo->año }}<br>
			    	<strong>Temporada de trabajo:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra_temporada_trabajo->temporada_trabajo->numero_temporada }}<br>
			    	<strong>Proyecto ECRO:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra_temporada_trabajo->temporada_trabajo->proyecto->nombre }}<br>
			    	<strong>Responsable de intervención:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->reponsable_solicitud->usuario->name }}<br>
			    	<strong>Fecha de inicio de intervención:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->fecha_intervencion }}<br>
			    	
			    </div>
	    	</div>

		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Datos de identificación de la muestra:</span> <br>
			    	<strong>Caracterización del tipo de análisis:</strong> <br>
			    	<strong>Nomenclatura de la muestra:</strong> <br>
			    	<strong>Lugar de resguardo de la muestra:</strong> {{ $resultadoAnalisis->lugar_resguardo_muestra }}<br>
			    	<strong>Fecha del Análisis Científico:</strong> {{ $resultadoAnalisis->fecha_analisis }}<br>
			    	<strong>Profesor responsable del Análisis Científico:</strong> {{ $resultadoAnalisis->profesor_responsable_analisis->name }}<br>
			    	<strong>Persona que realizó el Análisis Científico:</strong> {{ $resultadoAnalisis->persona_analisis->name }}<br>
			    	<strong>Forma de Obtención de la muestra:</strong> {{ $resultadoAnalisis->forma_obtencion_muestra->nombre }}<br>
			    	<strong>Ubicación de la toma de la muestra:</strong> {{ $resultadoAnalisis->ubicacion_de_toma_muestra }}<br>
			    </div>
	    	</div>

		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Análisis a realizar:</span> <br>
			    </div>
	    	</div>
		</main>
	</body>
</html>