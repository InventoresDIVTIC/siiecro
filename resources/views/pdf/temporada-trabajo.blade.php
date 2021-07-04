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
	    	<div class="col-100">
	    		<div class="text-left">
	    			<strong>Área a la que ingresa:</strong> {{ $temporada->proyecto->area ? $temporada->proyecto->area->nombre : "Sin asignar" }}<br>
	    			<strong>Fecha de entrada:</strong> {{ $temporada->created_at->format('Y-m-d h:i A') }}<br>
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
			    		@foreach ($temporada->obras_asignadas as $obra)
				    		<tr>
				    			<td>{{ $obra->folio }}</td>
				    			<td>{{ $obra->nombre }}</td>
				    			<td>
				    				@if($obra->tipo_bien_cultural->calcular_temporalidad == "si")
				    					{{ $obra->temporalidad ? $obra->temporalidad->nombre : "N/A" }}
				    				@else
				    					{{ $obra->año->format('Y') }} / {{ $obra->epoca->nombre }}
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
			    	<strong>Recibió<br></strong>
			    	Nombre y firma
			    </div>
			    <div class="col-50 inline-block">
			    	<strong>Entregó<br></strong>
			    	Nombre y firma
			    </div>
	    	</div>
	    	<div class="col-100 mt-md text-center">
			    <div class="col-50 inline-block">
			    	<strong>Vo.Bo</strong>
			    </div>
			    <div class="col-50 inline-block">
			    	<strong>Vo.Bo</strong>
			    </div>
	    	</div>

		</main>
	</body>
</html>