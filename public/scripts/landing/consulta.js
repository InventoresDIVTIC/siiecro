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
					busqueda: 	busqueda
				},
				beforeSend: function(){
					$("#div-loading").removeClass('hidden');
				},
				success: function(response){
					$("#div-resultados-busqueda").html(response);
					$("#div-loading").addClass('hidden');
				},
				error: function(){
					alert("error");
					$("#div-loading").addClass('hidden');
				}
			});
			
		}
    }
}