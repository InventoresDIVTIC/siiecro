jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos", // ID de la tabla
			"#carga-dt", // ID elemento del progreso
			"/dashboard/obras-tipo-de-material/carga", // URL datos
			[
				{ data: "id", 		      width: "10%"},
        { data: "nombre",       width: "75%"},
				{ data: "acciones",     width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear(){
  _mostrarFormulario("/dashboard/obras-tipo-de-material/create", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-tipo-de-material", //ID del Formulario
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
    _mostrarFormulario("/dashboard/obras-tipo-de-material/"+id+"/edit/", //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-crear", //Nombre modal
                        "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                        function(){

                          _cargarTabla(
                            "#dt-datos-interpretaciones", // ID de la tabla
                            "#carga-dt-interpretaciones", // ID elemento del progreso
                            "/dashboard/obras-tipo-de-material/cargar-interpretaciones/"+id, // URL datos
                            [
                              { data: "nombre",   width: "65%"},
                              { data: "acciones", width: "15%",   searchable: false,  orderable: false},
                            ], // Columnas
                          );

                        }, //Funcion para el success
                        "#form-obras-tipo-de-material", //ID del Formulario
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
  _mostrarFormulario("/dashboard/obras-tipo-de-material/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-tipo-de-material", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-datos");
            						});
                      });//Funcion en caso de guardar correctamente);
}

// INTERPRETACIONES PARTICULARES
function crearInterpretacionParticularCruzada(id_tipo_material)
{
  _mostrarFormulario("/dashboard/obras-tipo-de-material/crear-interpretacion-cruzada/" + id_tipo_material, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-interpretacion-cruzada", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#interpretacion_particular_cruzada_id').select2({
                          placeholder: 'Seleccione una opcion'
                        });
                        $('#tipo_material_cruzada_iter_id').val($('#tipo_material_cruzada_id').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-tipo-de-material-interpretacion-cruzada", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-interpretacion-cruzada", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-interpretacion-cruzada", function(){
                            _recargarTabla("#dt-datos-interpretaciones");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function editarInterpretacionParticularCruzada(id_de_interpretacion_cruzada)
{
  _mostrarFormulario("/dashboard/obras-tipo-de-material/editar-interpretacion-cruzada/"+id_de_interpretacion_cruzada, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-interpretacion-cruzada", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#interpretacion_particular_cruzada_id').select2({
                          placeholder: 'Seleccione una opción'
                        });
                        $('#tipo_material_cruzada_iter_id').val($('#tipo_material_cruzada_id').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-tipo-de-material-interpretacion-cruzada", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-interpretacion-cruzada", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-interpretacion-cruzada", function(){
                            _recargarTabla("#dt-datos-interpretaciones");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarInterpretacionParticularCruzada(id_de_interpretacion_cruzada)
{
  _mostrarFormulario("/dashboard/obras-tipo-de-material/aviso-eliminar-interpretacion-cruzada/"+id_de_interpretacion_cruzada, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-interpretacion-cruzada", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-tipo-de-material-eliminar-interpretacion-cruzada", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion-interpretacion-cruzada", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-interpretacion-cruzada", function(){
                          _recargarTabla("#dt-datos-interpretaciones");
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}
