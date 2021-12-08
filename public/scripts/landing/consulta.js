var tipoBusqueda = "";

jQuery(document).ready(function($) {
	// Inicializamos los botones de seleccion de busqueda
	$(".elemento-busqueda").each(function(index, el) {
		$(el).click(function(event) {
			comportamientoElementoBusqueda(el);
		});
	});
});

function comportamientoElementoBusqueda(elemento){
	// Quitamos la clase seleccionado a todos los elementos que la contengan
	$(".seleccionado").removeClass('seleccionado');

	// Le ponemos la clase seleccionado al elemento seleccionado
	$(elemento).addClass('seleccionado');

	$("#div-busqueda").removeClass('hidden');
	$("#txt-busqueda").html($(elemento).data("tipo-busqueda"));
	$("#input-busqueda").focus().select();
	tipoBusqueda = $(elemento).data("tipo-busqueda");
	$("#div-resultados-busqueda").html('');
}

function buscar(e){
	var tecla 				= 	(typeof e.which === "number") ? e.which : e.keyCode;
	if (tecla == 13){
		var busqueda 		= 	$.trim($("#input-busqueda").val());

		if (busqueda.length > 2){
			$.ajax({
				url: '/consulta',
				type: 'POST',
				data: {
					_token: 	$('meta[name="csrf-token"]').attr('content'),
					busqueda: 	busqueda,
					tipo: 		tipoBusqueda
				},
				beforeSend: function(){
					$("#div-resultados-busqueda").html('');
					$("#div-loading").removeClass('hidden');
				},
				success: function(response){
					// console.log(response);
					$("#div-resultados-busqueda").html(response);
					$("#div-loading").addClass('hidden');
					$('#no-registro, #area, #responsable-ecro, #no-proyecto-ecro, #proyecto-ecro, #temporada-ecro, #profe-responsable, #persona-realiza-analisis \
						, #anio, #epoca, #temporalidad, #autor, #cultura, #lugar_procedencia_actual, #lugar_procedencia_original, #tipo_bien_cultural, #tipo_material, #interpretacion_material').select2({
						placeholder: 'Elige una opción',
						width: '100%',
						allowClear: true
					});
				},
				error: function(){
					alert("error");
					$("#div-loading").addClass('hidden');
				}
			});
			
		}
    }
}

$(document.body).on('change',".filtros-administrativos", function (e) {
	let no_registro              = $('#no-registro').val();
	let area                     = $('#area').val().trim();
	let responsable_ecro         = $('#responsable-ecro').val().trim();
	let no_proyecto              = $('#no-proyecto-ecro').val();
	let proyecto                 = $('#proyecto-ecro').val().trim();
	let temporada                = $('#temporada-ecro').val();
	let profe_responsable        = $('#profe-responsable').val();
	let nomenclatura_muestra     = $('#nomenclatura-muestra').val();
	let persona_realiza_analisis = $('#persona-realiza-analisis').val();

	// GENERALES
	let anio 						= $('#anio').val();
	let epoca 						= $('#epoca').val();
	let temporalidad 				= $('#temporalidad').val();
	let autor 						= $('#autor').val();
	let cultura 					= $('#cultura').val();
	let lugar_procedencia_actual 	= $('#lugar_procedencia_actual').val();
	let lugar_procedencia_original 	= $('#lugar_procedencia_original').val();
	let tipo_bien_cultural 			= $('#tipo_bien_cultural').val();
	let tipo_material 				= $('#tipo_material').val();
	let interpretacion_material 	= $('#interpretacion_material').val();

   const filtros = {
		no_registro: no_registro,
		area: area,
		responsable_ecro: responsable_ecro,
		no_proyecto: no_proyecto,
		proyecto: proyecto,
		temporada: temporada,
		profe_responsable: profe_responsable,
		nomenclatura_muestra: nomenclatura_muestra,
		persona_realiza_analisis: persona_realiza_analisis,
		anio: anio,
		epoca: epoca,
		temporalidad: temporalidad,
		autor: autor,
		cultura: cultura,
		lugar_procedencia_actual: lugar_procedencia_actual,
		lugar_procedencia_original: lugar_procedencia_original,
		tipo_bien_cultural: tipo_bien_cultural,
		tipo_material: tipo_material,
		interpretacion_material: interpretacion_material,
   }

	// console.log(this.value);
	var busqueda 		= 	$.trim($("#input-busqueda").val());
	$.ajax({
		url: '/consulta',
		type: 'POST',
		data: {
			_token: 	$('meta[name="csrf-token"]').attr('content'),
			busqueda: 	busqueda,
			tipo: 		tipoBusqueda, 
			filtros: 	filtros
		},
		beforeSend: function(){
			$("#div-resultados-busqueda").html('');
			$("#div-loading").removeClass('hidden');

			// if ( proyecto ) {
			// 	_llenarSelect2Estatico("#temporada-ecro", "/dashboard/proyectos/temporadas-trabajo/select2", {
			// 	   proyecto_id:    proyecto
			// 	}, false, false, true);
			// }	
		},
		success: function(response){
			$("#div-resultados-busqueda").html(response);
			$("#div-loading").addClass('hidden');
			$('#no-registro, #area, #responsable-ecro, #no-proyecto-ecro, #proyecto-ecro, #temporada-ecro, #profe-responsable, #persona-realiza-analisis \
				, #anio, #epoca, #temporalidad, #autor, #cultura, #lugar_procedencia_actual, #lugar_procedencia_original, #tipo_bien_cultural, #tipo_material, #interpretacion_material').select2({
				placeholder: 'Elige una opción',
				width: '100%',
				allowClear: true
			});
		},
		error: function(){
			alert("error");
			$("#div-loading").addClass('hidden');
		}
	});
});
