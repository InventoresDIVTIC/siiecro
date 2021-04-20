jQuery(document).ready(function($) {
	_formAjax("#form-contacto", "#carga-contacto", "#div-error", function(respuesta){
		$("#div-exito").removeClass('hidden');
		$("#div-principal").addClass('hidden');
	});
});