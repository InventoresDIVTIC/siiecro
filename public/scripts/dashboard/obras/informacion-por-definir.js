jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/obras-informacion-por-definir/carga", // URL datos
			[
				{ data: "id", 		      width: "10%"},
        { data: "nombre",       width: "75%"},
				{ data: "acciones",     width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(){
  _mostrarFormulario("/dashboard/obras-informacion-por-definir/create", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-informacion-por-definir", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear", function(){
              							_recargarTabla("#dt-datos");
              						});
                      });//Funcion en caso de guardar correctamente);
}

function editar(id)
{
    _mostrarFormulario("/dashboard/obras-informacion-por-definir/"+id+"/edit/", //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-crear", //Nombre modal
                        "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                        function(){
                        }, //Funcion para el success
                        "#form-obras-informacion-por-definir", //ID del Formulario
                        "#carga-agregar", //Loading de guardar datos de formulario
                        "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                        function(){
                            _ocultarModal("#modal-crear", function(){
                							_recargarTabla("#dt-datos");
                						});
                        });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/dashboard/obras-informacion-por-definir/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-informacion-por-definir", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-datos");
            						});
                      });//Funcion en caso de guardar correctamente);
}