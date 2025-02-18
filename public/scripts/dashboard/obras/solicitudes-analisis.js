jQuery(document).ready(function($) {
	_cargarTabla(
			"#dt-datos-solicitudes-analisis", // ID de la tabla
			"#carga-dt-solicitudes-analisis", // ID elemento del progreso
			"/dashboard/solicitudes-analisis/carga/"+ $('#id').val(), // URL datos
			[
          { data: "fecha_intervencion", width: "30%"},
          { data: "name",               width: "30%"},
          { data: "temporada_trabajo",  width: "25%"},
          { data: "acciones",           width: "15%", 	searchable: false, 	orderable: false},
			], // Columnas
		);
});

function crear()
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/create/"+ $('#id').val(), //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-crear", //Nombre modal
                      "#tecnica", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#obra_id').val($('#id').val());
                       
                        $('#obra_usuario_asignado_id, #obra_temporada_trabajo_asignada_id').select2({
                          placeholder: "Seleccione una opción"
                        });

                        $("#fecha_intervencion").datepicker({
                           language:       'es',
                           format:         'yyyy-mm-dd',
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(respuesta){
                          _ocultarModal("#modal-crear", function(){
              							_recargarTabla("#dt-datos-solicitudes-analisis");
                            verMuestras(respuesta.id);
              						});
                      });//Funcion en caso de guardar correctamente);
}

function editar(id)
{
    _mostrarFormulario("/dashboard/solicitudes-analisis/" + id + "/edit/", //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-crear", //Nombre modal
                        "#tecnica", //Elemento al que se le dara focus una vez cargado el modal
                        function(){
                          $('#obra_usuario_asignado_id, #obra_temporada_trabajo_asignada_id').select2({
                            placeholder: "Seleccione una opción"
                          });
                          
                          $("#fecha_intervencion").datepicker({
                            language:       'es',
                            format:         'yyyy-mm-dd',
                         });

                          $("#dropzone-solicitud-analisis").dropzone({ 
                            url: "/dashboard/solicitudes-analisis/" + id + "/subir-esquema",
                            uploadMultiple: false,
                            parallelUploads: 1,
                            maxFiles: 10,
                            addRemoveLinks: false,
                            acceptedFiles: 'image/*',
                            sending: function(file, xhr, formData) {
                               formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                            },
                            error: function(file, message) {
                               $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message.mensaje);
                            },
                            success: function(file, message){
                               var drop    =  this;
                               setTimeout(function() {
                                 drop.removeFile(file);
                                 recargarImagenesEsquema(id);
                               }, 1000);
                            }
                          });

                          $('#carrusel-imagenes-esquema').owlCarousel({
                            loop:      false,
                            margin:    10,
                            nav:       false,
                            center:    false
                          });
                        }, //Funcion para el success
                        "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                        "#carga-agregar", //Loading de guardar datos de formulario
                        "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                        function(){
                            _ocultarModal("#modal-crear", function(){
                							_recargarTabla("#dt-datos-solicitudes-analisis");
                						});
                        });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/eliminar/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                      "#carga-eliminar", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
            						_ocultarModal("#modal-eliminar", function(){
            							_recargarTabla("#dt-datos-solicitudes-analisis");
            						});
                      });//Funcion en caso de guardar correctamente);
}

// CAMBIOS DE ESTATUS EN LAS SOLICTUDES
function aprobarSolicitudAnalisis(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/aprobar-solicitud-analisis/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-aprobar-solicitud-analisis", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-solicitud-analisis", //ID del Formulario
                  "", //Loading de guardar datos de formulario
                  "#div-notificacion-solicitud-analisis", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-aprobar-solicitud-analisis", function(){
                      _recargarTabla("#dt-datos-solicitudes-analisis");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function rechazarSolicitudAnalisis(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/rechazar-solicitud-analisis/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-rechazar-solicitud-analisis", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-solicitud-analisis", //ID del Formulario
                  "", //Loading de guardar datos de formulario
                  "#div-notificacion-solicitud-analisis", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-rechazar-solicitud-analisis", function(){
                      _recargarTabla("#dt-datos-solicitudes-analisis");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function ponerEnRevisionSolicitudAnalisis(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/poner-en-revision-solicitud-analisis/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-poner-en-revision-solicitud-analisis", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-solicitud-analisis", //ID del Formulario
                  "", //Loading de guardar datos de formulario
                  "#div-notificacion-solicitud-analisis", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-poner-en-revision-solicitud-analisis", function(){
                      _recargarTabla("#dt-datos-solicitudes-analisis");
                    });
                  });//Funcion en caso de guardar correctamente);
}


// MUESTRAS DE LAS SOLICITUDES

function verMuestras(id)
{
    _mostrarFormulario("/dashboard/solicitudes-analisis/ver-muestras/"+id, //Url solicitud de datos
                        "#modal-1", //Div que contendra el modal
                        "#modal-ver-muestras", //Nombre modal
                        "#tecnica", //Elemento al que se le dara focus una vez cargado el modal
                        function(){
                          // MODIFICACION (UNA MASSSS)
                          $('#obra_usuario_asignado_id, #obra_temporada_trabajo_asignada_id').select2({
                            placeholder: "Seleccione una opción"
                          });
                          
                          $("#fecha_intervencion").datepicker({
                            language:       'es',
                            format:         'yyyy-mm-dd',
                         });

                          $("#dropzone-solicitud-analisis").dropzone({ 
                            url: "/dashboard/solicitudes-analisis/" + id + "/subir-esquema",
                            uploadMultiple: false,
                            parallelUploads: 1,
                            maxFiles: 10,
                            addRemoveLinks: false,
                            acceptedFiles: 'image/*',
                            sending: function(file, xhr, formData) {
                               formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                            },
                            error: function(file, message) {
                               $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message.mensaje);
                            },
                            success: function(file, message){
                               var drop    =  this;
                               setTimeout(function() {
                                 drop.removeFile(file);
                                 recargarImagenesEsquema(id);
                               }, 1000);
                            }
                          });

                          $('#carrusel-imagenes-esquema').owlCarousel({
                            loop:      false,
                            margin:    10,
                            nav:       false,
                            center:    false
                          });
                          // FIN DE MODIFICACION (UNA MASSS)
                          
                          $('#nombre_obra_solicitud').text($('#nombre_obra').text());
                          $('#folio_obra_solicitud').text($('#folio_obra').text());
                          recargarImagenesEsquema(id);
                          _cargarTabla(
                            "#dt-datos-solicitudes-analisis-muestras", // ID de la tabla
                            "#carga-dt-solicitudes-analisis-muestras", // ID elemento del progreso
                            "/dashboard/solicitudes-analisis/cargar-muestras/"+id, // URL datos
                            [
                              { data: "nombre",                 width: "25%"},
                              { data: "no_muestra",             width: "10%"},
                              { data: "nomenclatura",           width: "10%"},
                              { data: "informacion_requerida",  width: "10%"},
                              { data: "motivo",                 width: "10%"},
                              { data: "descripcion_muestra",    width: "10%"},
                              { data: "ubicacion",              width: "10%"},
                              { data: "acciones",               width: "15%",   searchable: false,  orderable: false},
                            ], // Columnas
                          );
                        }, //Funcion para el success
                        "#form-obras-detalle-solicitudes-analisis", //ID del Formulario
                        "#carga-agregar", //Loading de guardar datos de formulario
                        "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                        function(){
                            _ocultarModal("#modal-ver-muestras", function(){
                              _recargarTabla("#dt-datos-solicitudes-analisis");
                            });
                        });//Funcion en caso de guardar correctamente);
}

function toggleEdicionSolicitudesAnalisis(estatus){
// True: Habilitar edicion
// False: Deshabilitar edicion
  if(estatus) {
    $("#form-obras-detalle-solicitudes-analisis").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar]), button:not([no-editar])').attr('disabled', false);
    $("#btn-group-habilitar-edicion-analisis").addClass('hidden');
    $("#btn-group-no-editar-analisis").removeClass('hidden');
    $(".dropzones-imagenes").removeClass('hidden');
  } else {
    $("#form-obras-detalle-solicitudes-analisis").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar]), button:not([no-editar])').attr('disabled', true);
    $("#btn-group-habilitar-edicion-analisis").removeClass('hidden');
    $("#btn-group-no-editar-analisis").addClass('hidden');
    $(".dropzones-imagenes").addClass('hidden');
  }
}

function crearMuestra(id_de_solicitud)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/crear-muestra", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-muestra", //Nombre modal
                      "#no_muestra", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#tipo_analisis_id').select2({
                          placeholder: "Seleccione una opción"
                        });
                        $('#solicitud_analisis_id').val(id_de_solicitud);
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis-crear-muestra", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion-muestra", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-muestra", function(){
                            _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function editarMuestra(id_de_muestra)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/editar-muestra/"+id_de_muestra, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-crear-muestra", //Nombre modal
                      "#no_muestra", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        $('#tipo_analisis_id').select2({
                          placeholder: "Seleccione una opción"
                        });
                        $('#solicitud_analisis_id').val($('#id_de_solicitud').val());
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis-crear-muestra", //ID del Formulario
                      "#carga-agregar", //Loading de guardar datos de formulario
                      "#div-notificacion-muestra", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                          _ocultarModal("#modal-crear-muestra", function(){
                            _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                            // evita el freezing cuando se completa la operacion correctamente
                            $('body').addClass('modal-open');
                          });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarMuestra(id)
{
  _mostrarFormulario("/dashboard/solicitudes-analisis/aviso-eliminar-muestra/"+id, //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-muestra", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){
                        // función para evitar el frezzing del modal cuando se se cancela por medio del boton data-dismiss
                        $(document).on('click', '[data-dismiss="modal"]', function(){
                          $('body').addClass('modal-open');
                        });
                      }, //Funcion para el success
                      "#form-obras-detalle-solicitudes-analisis-eliminar-muestra", //ID del Formulario
                      "#carga-eliminar-muestra", //Loading de guardar datos de formulario
                      "#div-notificacion-eliminar-muestra", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-muestra", function(){
                          _recargarTabla("#dt-datos-solicitudes-analisis-muestras");
                          // evita el freezing cuando se completa la operacion correctamente
                          $('body').addClass('modal-open');
                        });
                      });//Funcion en caso de guardar correctamente);
}

function eliminarImagenEsquemaSolicitudAnalisis(id, solicitud_analisis_id){
  _mostrarFormulario("/dashboard/solicitudes-analisis/"+id+"/eliminar-esquema/", //Url solicitud de datos
                      "#modal-2", //Div que contendra el modal
                      "#modal-eliminar-imagen", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-eliminar-imagen", //ID del Formulario
                      "#carga-eliminar-imagen", //Loading de guardar datos de formulario
                      "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-imagen", function(){
                          recargarImagenesEsquema(solicitud_analisis_id);
                        });
                      });//Funcion en caso de guardar correctamente);
}

function recargarImagenesEsquema(solicitud_analisis_id){
  $.ajax({
    url: '/dashboard/solicitudes-analisis/' + solicitud_analisis_id + '/ver-esquema',
    type: 'GET',
    success: function(respuesta){
      $("#contenedor-imagnes-esquema").html(respuesta);
      $('#carrusel-imagenes-esquema').owlCarousel({
        loop:      false,
        margin:    10,
        nav:       false,
        center:    false
      });
    },
    error: function(){
      _toast("error", "Hubo un error al obtener las imagenes, intenta de nuevo mas tarde");
    }
  });
  
}