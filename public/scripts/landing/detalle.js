jQuery(document).ready(function($) {
	buscarObrasRecomendadas($("#obra_id").val());
});


function buscarObrasRecomendadas(obra_id){
	$.ajax({
		url: '/consulta-obra/' + obra_id,
		type: 'GET',
		beforeSend: function(){
			$("#div-obras-recomendadas").removeClass('hidden');
		},
		success: function(contenido){
			$("#respuesta-obras-recomendadas").html(contenido);

			$("#carrusel-recomendaciones").owlCarousel({
			    loop: 			true,
			    margin: 		10,
			    nav: 			true,
			    autoplay: 		true,
			    responsive:{
			        0:{
			            items: 	1
			        },
			        600:{
			            items: 	3
			        },
			        1000:{
			            items: 	5
			        }
			    }
			});
		},
		error: function(){
			$("#respuesta-obras-recomendadas").html("Hubo un error al obtener las obras relacionadas");
		}
	})
	
}