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
	    			<strong>Fecha de salida:</strong> @if ($temporada->obras_asignadas->whereNotNull('fecha_salida')->count()) {{ $temporada->obras_asignadas->whereNotNull('fecha_salida')->first()->fecha_salida->format('Y-m-d') }} @endif<br>
	    		</div>
	    	</div>
		    <hr class="semi">
	    	<div class="col-100">
	    		<div class="text-left">
			    	<span class="subtitulo">Información de identificación:</span><br>
			    	<strong>Proyecto ECRO:</strong> {{ $temporada->proyecto->nombre }}<br>
			    	<strong>No. de Proyecto ECRO:</strong> {{ $temporada->proyecto->nombre }}<br>
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
			    		@foreach ($temporada->obras_asignadas->whereNotNull('fecha_salida') as $obra)
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
	    	<div class="col-100 mt-lg text-center">
			    <div class="col-50 inline-block">
			    	<strong>Recibió</strong><br>
					@if (isset($obra))
						<small>{{ $obra->persona_entrego != "" ? $obra->persona_entrego : "N/A" }}</small>
					@endif
			    </div>
			    <div class="col-50 inline-block">
			    	<strong>Entregó</strong><br>
					@if (isset($obra))
						<small>{{ $obra->usuario_recibio ? $obra->usuario_recibio->name : "N/A" }}</small>
					@endif
			    </div>
	    	</div>
	    	<div class="col-100 mt-md text-center">
			    <div class="col-50 inline-block">
			    	<strong>Vo.Bo</strong><br>
					Lic. Miriam Limón Gallegos<br>
					<small><strong>Coordinadora de carrera</strong></small>
			    </div>
			    <div class="col-50 inline-block">
			    	<strong>Vo.Bo</strong><br>
					Mtra. Gilda María Pasco Saldaña<br>
					<small><strong>Directora académica</strong></small>
			    </div>
	    	</div>

		</main>
	</body>
</html>