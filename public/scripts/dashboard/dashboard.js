var ctx_bienes, ctx_tipos_objetos, ctx_areas;
var grafica_bienes, grafica_tipos_objetos, grafica_areas;

jQuery(document).ready(function($) {
	cargarCraficaObrasBienesCulturales();
	cargarCraficaObrasTiposObjetos();
	cargarCraficaObrasAreas();

	_cargarTabla(
		"#dt-obras", // ID de la tabla
		"#carga-dt-obras", // ID elemento del progreso
		"/dashboard/tabla-obras", // URL datos
		[
			{ data: "folio", 		width: "20%", 	searchable: false, 	orderable: false},
    		{ data: "nombre",     	width: "35%"},
    		{ data: "nombre_area", 	width: "30%", 	name: 'a.nombre'},
			{ data: "acciones", 	width: "5%", 	searchable: false, 	orderable: false},
		], // Columnas
	);

	_cargarTabla(
		"#dt-solicitudes", // ID de la tabla
		"#carga-dt-solicitudes", // ID elemento del progreso
		"/dashboard/tabla-solicitudes", // URL datos
		[
			{ data: "obra", 				width: "20%", 	searchable: false, 	orderable: false},
			{ data: "fecha_intervencion", 	width: "30%"},
			{ data: "temporada",    		width: "35%", 	searchable: false, 	orderable: false},
			{ data: "acciones", 			width: "15%", 	searchable: false, 	orderable: false},
		], // Columnas
	);

	_cargarTabla(
		"#dt-resultados", // ID de la tabla
		"#carga-dt-resultados", // ID elemento del progreso
		"/dashboard/tabla-resultados", // URL datos
		[
			{ data: "obra", 			width: "15%", 	searchable: false, 	orderable: false},
			{ data: "fecha_analisis", 	width: "15%"},
			{ data: "nomenclatura",     width: "15%", 	name: 'muestra.nomenclatura'},
			{ data: "asesor", 			width: "25%", 	name: 'user_asesor.name'},
			{ data: "persona", 			width: "25%", 	name: 'user_persona.name'},
			{ data: "acciones", 		width: "5%", 	searchable: false, 	orderable: false},
		], // Columnas
	);
});

function cargarCraficaObrasBienesCulturales(){
	if ($("#obras-bienes-culturales").length > 0) {
		var ctx_bienes 	= 	document.getElementById('obras-bienes-culturales').getContext('2d');
		$.ajax({
			url: '/dashboard/grafica-obras-bienes-culturales',
			dataType: 'JSON',
			type: 'GET',
			beforeSend: function(){

			},
			success: function(response){
				grafica_bienes 	=	new Chart(ctx_bienes, 	{
																type: 'pie',
																data: response,
																options: {
																	responsive: true,
																	legend: {
																		position: 'right',
																	},
																	title: {
																		display: true,
																		text: 'Obras por bienes culturales'
																	},
																	scale: {
																		ticks: {
																			beginAtZero: true
																		},
																		reverse: false
																	},
																	animation: {
																		animateRotate: false,
																		animateScale: true
																	}
																}
															});
			},
			error: function(xhr, ajaxOptions, thrownError){
				_errorEjecucion(xhr);
			}
		});
	}
}

function cargarCraficaObrasTiposObjetos(){
	if ($("#obras-tipos-objeto").length  > 0) {
		var ctx_tipos_objetos 	= 	document.getElementById('obras-tipos-objeto').getContext('2d');
		$.ajax({
			url: '/dashboard/grafica-obras-tipos-objeto',
			dataType: 'JSON',
			type: 'GET',
			beforeSend: function(){

			},
			success: function(response){
				grafica_tipos_objetos 	=	new Chart(ctx_tipos_objetos, 	{
																type: 'pie',
																data: response,
																options: {
																	responsive: true,
																	legend: {
																		position: 'right',
																	},
																	title: {
																		display: true,
																		text: 'Obras por tipos de objeto'
																	},
																	scale: {
																		ticks: {
																			beginAtZero: true
																		},
																		reverse: false
																	},
																	animation: {
																		animateRotate: false,
																		animateScale: true
																	}
																}
															});
			},
			error: function(xhr, ajaxOptions, thrownError){
				_errorEjecucion(xhr);
			}
		});
	}
}

function cargarCraficaObrasAreas(){
	if ($("#obras-areas").length > 0) {
		var ctx_areas 	= 	document.getElementById('obras-areas').getContext('2d');
		$.ajax({
			url: '/dashboard/grafica-obras-areas',
			dataType: 'JSON',
			type: 'GET',
			beforeSend: function(){

			},
			success: function(response){
				grafica_areas 	=	new Chart(ctx_areas, 	{
																type: 'pie',
																data: response,
																options: {
																	responsive: true,
																	legend: {
																		position: 'top',
																	},
																	title: {
																		display: true,
																		text: 'Obras por área'
																	},
																	scale: {
																		ticks: {
																			beginAtZero: true
																		},
																		reverse: false
																	},
																	animation: {
																		animateRotate: false,
																		animateScale: true
																	}
																}
															});
			},
			error: function(xhr, ajaxOptions, thrownError){
				_errorEjecucion(xhr);
			}
		});
	}
}
