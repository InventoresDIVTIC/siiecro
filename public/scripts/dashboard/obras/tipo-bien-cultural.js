jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/obras-tipo-bien-cultural/carga", // URL datos
			[
				{ data: "id", 		      width: "10%"},
        { data: "nombre",       width: "80%"},
				{ data: "acciones",     width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(){
  _mostrarFormulario("/dashboard/obras-tipo-bien-cultural/create", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                          $("#color_hexadecimal").colorpicker();
                      }, //Funcion para el success
                      "#form-obras-tipo-bien-cultural", //ID del Formulario
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
    _mostrarFormulario("/dashboard/obras-tipo-bien-cultural/"+id+"/edit/", //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-crear", //Nombre modal
                        "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                        function(){
                            $("#color_hexadecimal").colorpicker();

                            _cargarTabla(
                              "#dt-datos-terminos-relacionados", // ID de la tabla
                              "#carga-dt-terminos-relacionados", // ID elemento del progreso
                              "/dashboard/obras-tipo-bien-cultural/cargar-terminos-relacionados/" + id, // URL datos
                              [
                                // { data: "id",           width: "10%"},
                                { data: "nombre",       width: "85%"},
                                { data: "acciones",     width: "15%",   searchable: false,  orderable: false},
                              ], // Columnas
                            );

                        }, //Funcion para el success
                        "#form-obras-tipo-bien-cultural", //ID del Formulario
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
  _mostrarFormulario("/dashboard/obras-tipo-bien-cultural/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-tipo-bien-cultural", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-datos");
            						});
                      });//Funcion en caso de guardar correctamente);
}

// TIPO DE BIEN CULTURAL TESAUROS TÉRMINOS RELACIONADOS
function crearTerminoRelacionado()
{
  _mostrarFormulario("/dashboard/obras-tipo-bien-cultural/crear-terminos-relacionados", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-terminos-relacionados", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#tipo_bien_cultural_id').val($('#id_tipo_bien_cultural').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-tipo-bien-cultural-terminos-relacionados", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-terminos-relacionados", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-terminos-relacionados", function(){
                            _recargarTabla("#dt-datos-terminos-relacionados");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function editarTerminoRelacionado(id_de_termino_relacionado)
{
  _mostrarFormulario("/dashboard/obras-tipo-bien-cultural/editar-terminos-relacionados/"+id_de_termino_relacionado, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-terminos-relacionados", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#tipo_bien_cultural_id').val($('#id_tipo_bien_cultural').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-tipo-bien-cultural-terminos-relacionados", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-terminos-relacionados", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-terminos-relacionados", function(){
                            _recargarTabla("#dt-datos-terminos-relacionados");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarTerminoRelacionado(id_de_termino_relacionado)
{
  _mostrarFormulario("/dashboard/obras-tipo-bien-cultural/aviso-eliminar-terminos-relacionados/"+id_de_termino_relacionado, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-terminos-relacionados", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-tipo-bien-cultural-terminos-relacionados", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion-eliminar-terminos-relacionados", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-terminos-relacionados", function(){
                          _recargarTabla("#dt-datos-terminos-relacionados");
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}