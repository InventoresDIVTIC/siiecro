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
		    	<span class="titulo">Registro de resultados de análisis</span><br>
		    </div>
		    <hr>
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Datos generales de la obra:</span><br>
			    	<strong>No. de registro de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->folio }}<br>
			    	<strong>Titulo de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->nombre }}<br>

			    	@if ($resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->tipo_bien_cultural->calcular_temporalidad == "si")
			    		<strong>Temporalidad:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->temporalidad ? $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->temporalidad->nombre : "N/A" }}<br>
			    	@else
			    		<strong>Año de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->año ? $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->año->format('Y') : "N/A" }}<br>
			    		<strong>Época de la obra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->epoca->nombre }}<br>
			    	@endif
			    	
			    	<strong>Tecnica:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->tipo_objeto->nombre }}<br>
			    	<strong>Dimensiones:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->solicitud_analisis->obra->etiquetaDimensiones() }}<br>
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
			    	<strong>Caracterización del tipo de análisis:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->tipo_analisis->nombre }} <br>
			    	<strong>Nomenclatura de la muestra:</strong> {{ $resultadoAnalisis->solicitud_analisis_muestra->nomenclatura }} <br>
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
			    	<span class="subtitulo">Esquema de toma de muestra:</span> <br>
			    	@foreach ($resultadoAnalisis->imagenes_resultados_esquema_muestra as $imagen_muestra)
			    		<div class="col-100 text-center">
			    			<img src="{{ asset('img/obras/resultados-analisis-esquema-muestra/'.$imagen_muestra->imagen) }}" style="height: 200px;">
			    		</div>
			    	@endforeach
			    </div>
	    	</div>

		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Características de observación preliminar:</span> <br>
			    	<strong>Tipo de material:</strong> {{ $resultadoAnalisis->tipo_material ? $resultadoAnalisis->tipo_material->nombre : "N/A" }}<br>
			    	<strong>Descripción:</strong> {{ $resultadoAnalisis->descripcion }}<br>
			    	<strong>Ruta de acceso a microfotografía:</strong> {{ $resultadoAnalisis->ruta_acceso_microfotografia }}<br>
			    	@foreach ($resultadoAnalisis->imagenes_resultados_esquema_microfotografia as $imagen_muestra)
					{{$imagen_muestra->imagen}}
			    		<div class="col-100 text-center mt-md">
			    			<img src="{{ asset('img/obras/resultados-analisis-esquema-microfotografia/'.$imagen_muestra->imagen) }}" style="height: 200px;">
			    		</div>
			    	@endforeach
			    </div>
	    	</div>

		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Datos analíticos (resultados):</span> <br>

					@foreach ($resultadoAnalisis->resultados as $resultado)
						<table class="col-100">
							<tr>
								<td>
									<small class="fs-12"><strong>Información por definir:</strong></small><br>
									{{ $resultado->informacion_por_definir->nombre }}
								</td>
								<td>
									<small class="fs-12"><strong>Análisis a realizar:</strong></small><br>
									{{ $resultado->analisis_realizar->nombre }}
								</td>
								<td>
									<small class="fs-12"><strong>Técnica analítica:</strong></small><br>
									{{ $resultado->tecnica_analitica->nombre }}
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<small class="fs-12"><strong>Información del equipo</strong></small><br>
									{{ $resultado->informacion_del_equipo ? $resultado->informacion_del_equipo->nombre : "N/A" }}
								</td>
							</tr>
							@if (Auth::user()->rol->acceso_a_datos_avanzado)
								<tr>
									<td colspan="3">
										<small class="fs-12"><strong>Ruta de acceso</strong></small><br>
										{{ $resultado->ruta_acceso_imagen }}
									</td>
								</tr>
							@endif
							<tr>
								<td>
									<small class="fs-12"><strong>Interpretación</strong></small><br>
									<i style="font-size:11px;">{!! nl2br($resultado->interpretacion) !!}</i>
								</td>
								<td colspan="2" class="text-center">
									<small class="fs-12"><strong>Microfotografía, datos ó imagen</strong></small>
									@foreach ($resultado->esquema_analiticos_microfotografias as $imagen)
										<br><br>
										<img src="{{ asset('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$imagen->imagen) }}" width="300px"><br>
									@endforeach
								</td>
							</tr>
						</table>
					@endforeach
			    	{{-- <table>
			    		<thead>
				    		<tr>
					    		<th class="col-10 fs-6">Información por definir</th>
					    		<th class="col-10 fs-6">Análisis a realizar</th>
					    		<th class="col-10 fs-6">Técnica analítica</th>
					    		<th class="col-10 fs-6">Interpretación</th>
					    		<th class="col-10 fs-6">Microfotografía, datos ó imagen</th>
					    		<th class="col-15 fs-6">Información del equipo</th>
								@if (Auth::user()->rol->acceso_a_datos_avanzado)
					    			<th class="col-10 fs-6">Ruta de acceso</th>
								@endif
				    		</tr>
				    	</thead>
				    	<tbody>
				    		@foreach ($resultadoAnalisis->resultados as $resultado)
				    			<tr>
				    				<td class="fs-6">{{ $resultado->informacion_por_definir->nombre }}</td>
				    				<td class="fs-6">{{ $resultado->analisis_realizar->nombre }}</td>
				    				<td class="fs-6">{{ $resultado->tecnica_analitica->nombre }}</td>
				    				<td class="fs-6">{!! nl2br($resultado->interpretacion) !!}</td>
									<td class="fs-6">
				    					@foreach ($resultado->esquema_analiticos_microfotografias as $imagen)
				    						<img src="{{ asset('img/obras/resultados-analisis-esquema-analiticos-microfotografia/'.$imagen->imagen) }}" height="50px"><br>
				    					@endforeach
				    				</td>
				    				<td class="fs-6">{{ $resultado->informacion_del_equipo ? $resultado->informacion_del_equipo->nombre : "N/A" }}</td>
									@if (Auth::user()->rol->acceso_a_datos_avanzado)
				    					<td class="fs-6">{{ $resultado->ruta_acceso_imagen }}</td>
									@endif
				    			</tr>
				    		@endforeach
				    	</tbody>
			    	</table> --}}
			    </div>
	    	</div>

		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Conclusión general:</span> <br>
			    	<p>{!! nl2br($resultadoAnalisis->conclusion_general) !!}</p>
			    	<strong>Interpretación material:</strong> {{ $resultadoAnalisis->cadenaInterpretacionesParticulares() }}<br>
			    </div>
	    	</div>
		</main>
	</body>
</html>