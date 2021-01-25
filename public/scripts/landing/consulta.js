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
	$(".elemento-busqueda-seleccionado").removeClass('elemento-busqueda-seleccionado');

	// Le ponemos la clase seleccionado al elemento seleccionado
	$(elemento).addClass('elemento-busqueda-seleccionado');

	$("#div-busqueda").removeClass('hidden');
	$("#txt-busqueda").html($(elemento).data("tipo-busqueda"));
	$("#busqueda").focus().select();
}