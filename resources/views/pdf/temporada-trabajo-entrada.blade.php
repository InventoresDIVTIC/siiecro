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
	    	<div class="col-100">
	    		<div class="text-left">
	    			<strong>Área:</strong> {{ $temporada->proyecto->area ? $temporada->proyecto->area->nombre : "Sin asignar" }}<br>
	    			<strong>Fecha de entrada:</strong> {{ $temporada->created_at->format('Y-m-d') }}<br>
	    		</div>
	    	</div>
		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Información de identificación:</span><br>
			    	<strong>Proyecto ECRO:</strong> {{ $temporada->proyecto->nombre }}<br>
			    	<strong>No. de Proyecto ECRO:</strong> {{ $temporada->proyecto->folio }}<br>
			    	<strong>Temporada del Proyecto:</strong> {{ $temporada->año }} - {{ $temporada->numero_temporada }}<br>
			    </div>
	    	</div>
		    <hr class="semi">
		    <div class="col-100">
			    <span class="subtitulo">Datos generales: Obras del proyecto</span><br>
			    <table class="col-100 mt-sm tabla-contenido">
			    	<thead>
			    		<tr>
				    		<th class="col-20">No. de Registro</th>
				    		<th class="col-20">Titulo</th>
				    		<th class="col-20">Año / Época / Temporalidad</th>
				    		<th class="col-20">Tipo de objeto</th>
				    		<th class="col-20">No. Inventario ó códigos de procedencia</th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		@foreach ($temporada->obras_asignadas as $obra)
				    		<tr>
				    			<td>{{ $obra->folio }}</td>
				    			<td>{{ $obra->nombre }}</td>
				    			<td>
				    				@if($obra->tipo_bien_cultural->calcular_temporalidad == "si")
				    					{{ $obra->temporalidad ? $obra->temporalidad->nombre : "N/A" }}
				    				@else
										@if ($obra->estatus_epoca == "Aproximado")
											{{ $obra->epoca->nombre }}
										@else
				    						{{ $obra->año->format('Y') }} / {{ $obra->epoca->nombre }}
										@endif
				    				@endif
				    			</td>
				    			<td>{{ $obra->tipo_objeto->nombre }}</td>
				    			<td>{{ $obra->numero_inventario }}</td>
				    		</tr>
			    		@endforeach
			    	</tbody>
			    </table>
		    </div>
		    <hr class="semi">
			<div style="height: 50px"></div>
			<div class="no-break">
				<div class="col-100 mt-lg text-center">
					<div class="col-50 inline-block">
						<strong>Recibió<br></strong>
						@if (isset($obra))
							<small>{{ $obra->usuario_recibio ? $obra->usuario_recibio->name : "N/A" }}</small>
						@endif<br>
						<small><strong>Profesor(a) STR</strong></small>
					</div>
					<div class="col-50 inline-block">
						<strong>Entregó<br></strong>
						@if (isset($obra))
							<small>{{ $obra->persona_entrego != "" ? $obra->persona_entrego : "N/A" }}</small>
						@endif<br>
						<small><strong>Propietario o custodio</strong></small>
					</div>
				</div>
				<div class="col-100 mt-lg text-center">
					<div class="col-50 inline-block">
						<strong>Vo.Bo</strong><br>
						{{ $configuracion->director_general }}<br>
						<small><strong>Director(a) general</strong></small>
					</div>
					<div class="col-50 inline-block">
						<strong>Vo.Bo</strong><br>
						{{ $configuracion->director_academico }}<br>
						<small><strong>Director(a) académica</strong></small>
					</div>
				</div>
			</div>

		</main>
	</body>
</html>