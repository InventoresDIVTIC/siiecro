jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/obras-analisis-a-realizar/carga", // URL datos
			[
				{ data: "id", 		      width: "10%"},
        { data: "nombre",       width: "75%"},
				{ data: "acciones",     width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(){
  _mostrarFormulario("/dashboard/obras-analisis-a-realizar/create", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-analisis-a-realizar", //ID del Formulario
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
    _mostrarFormulario("/dashboard/obras-analisis-a-realizar/"+id+"/edit/", //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-crear", //Nombre modal
                        "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                        function(){

                          _cargarTabla(
                            "#dt-datos-tecnicas-analiticas", // ID de la tabla
                            "#carga-dt-tecnicas-analiticas", // ID elemento del progreso
                            "/dashboard/obras-analisis-a-realizar/cargar-tecnicas/"+id, // URL datos
                            [
                              { data: "nombre",   width: "65%"},
                              { data: "acciones", width: "15%",   searchable: false,  orderable: false},
                            ], // Columnas
                          );

                        }, //Funcion para el success
                        "#form-obras-analisis-a-realizar", //ID del Formulario
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
  _mostrarFormulario("/dashboard/obras-analisis-a-realizar/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-analisis-a-realizar", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-datos");
            						});
                      });//Funcion en caso de guardar correctamente);
}

function crearTecnicaAnalitica()
{
  _mostrarFormulario("/dashboard/obras-analisis-a-realizar/crear-tecnica", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-tecnica", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#analisis_a_realizar_id').val($('#id_analisis_a_realizar').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-analisis-a-realizar-tecnica", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-tecnica", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-tecnica", function(){
                            _recargarTabla("#dt-datos-tecnicas-analiticas");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function editarTecnicaAnalitica(id_de_tecnica)
{
  _mostrarFormulario("/dashboard/obras-analisis-a-realizar/editar-tecnica/"+id_de_tecnica, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-tecnica", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#analisis_a_realizar_id').val($('#id_analisis_a_realizar').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-analisis-a-realizar-tecnica", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-tecnica", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-tecnica", function(){
                            _recargarTabla("#dt-datos-tecnicas-analiticas");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarTecnicaAnalitica(id_de_tecnica)
{
  _mostrarFormulario("/dashboard/obras-analisis-a-realizar/aviso-eliminar-tecnica/"+id_de_tecnica, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-tecnica", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-analisis-a-realizar-tecnica", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-tecnica", function(){
                          _recargarTabla("#dt-datos-tecnicas-analiticas");
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}