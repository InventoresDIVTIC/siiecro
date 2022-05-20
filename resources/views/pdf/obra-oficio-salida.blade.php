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
	    			<strong>Área:</strong> {{ $obra->area ? $obra->area->nombre : "Sin asignar" }}<br>
	    			<strong>Fecha de salida:</strong> {{ $obra->fecha_salida ? $obra->fecha_salida->format('Y-m-d') : "N/A" }}<br>
	    		</div>
	    	</div>
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
			    	@endif
			    </div>
	    	</div>
		    <hr class="semi">
			<div style="height: 50px"></div>
            {{-- Como es oficio de salida, quien recibe es quien entrego realmente, osea se cambian --}}
	    	<div class="no-break">
				<div class="col-100 mt-lg text-center">
					<div class="col-50 inline-block">
						<strong>Recibió</strong><br>
						<small>{{ $obra->persona_recibio != "" ? $obra->persona_recibio : "N/A" }}</small><br>
						<small><strong>Propietario o custodio</strong></small>
					</div>
					<div class="col-50 inline-block">
						<strong>Entregó</strong><br>
						<small>{{ $obra->usuario_entrego ? $obra->usuario_entrego->name : "N/A" }}</small><br>
						<small><strong>Profesor(a) STR</strong></small>
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
						<small><strong>Director(a) académico(a)</strong></small>
					</div>
				</div>
			</div>

		</main>
	</body>
</html>