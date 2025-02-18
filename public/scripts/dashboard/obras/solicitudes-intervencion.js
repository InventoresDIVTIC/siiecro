jQuery(document).ready(function($) {
  _cargarTabla(
      "#dt-datos", // ID de la tabla
      "#carga-dt", // ID elemento del progreso
      "/dashboard/obras/solicitudes-intervencion/carga", // URL datos
      [
        { data: "nombre",               width: "30%"},
        { data: "tipo_bien_cultural",   width: "15%",   name: "obc.nombre"},
        { data: "tipo_objeto",          width: "10%",   name: "oto.nombre"},
        { data: "año",                  width: "5%"},
        { data: "epoca",                width: "15%",   name: "oe.nombre"},
        { data: "temporalidad",         width: "15%",   name: "ot.nombre"},
        { data: "acciones",             width: "10%",   searchable: false,  orderable: false},
      ], // Columnas
  );
});

function crear(){
  _mostrarFormulario("/dashboard/obras/create", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                    function(){

                      $("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca").select2({
                        placeholder: "Seleccione una opción"
                      });

                      $("#año").datepicker({
                        language:       'es',
                        format:         'yyyy',
                        minViewMode:    'years',
                        startDate:      '1400',
                        endDate:        '2040',
                      });

                      $('#tipo_bien_cultural_id').on('select2:select', function (e) {
                        comportamientoTipoBienCultural(e.params.data.id);
                      });

                      $('#estatus_epoca').on('select2:select', function (e) {
                        comportamientoStatusEpoca(e.params.data.id);
                      });

                    }, //Funcion para el success
                    "#form-obras", //ID del Formulario
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
    _mostrarFormulario("/dashboard/obras/"+id+"/edit/", //Url solicitud de datos
                    "#modal-1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus una vez cargado el modal
                    function(){

                      $("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca").select2({
                        placeholder: "Seleccione una opción"
                      });

                      $("#año").datepicker({
                        language:       'es',
                        format:         'yyyy',
                        minViewMode:    'years',
                        startDate:      '1400',
                        endDate:        '2040',
                      });

                      $('#tipo_bien_cultural_id').on('select2:select', function (e) {
                        comportamientoTipoBienCultural(e.params.data.id);
                      });

                      $('#estatus_epoca').on('select2:select', function (e) {
                        comportamientoStatusEpoca(e.params.data.id);
                      });

                      comportamientoTipoBienCultural($('#tipo_bien_cultural_id').val());
                      comportamientoStatusEpoca($('#estatus_epoca').val());

                    }, //Funcion para el success
                    "#form-obras", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                        _ocultarModal("#modal-crear", function(){
                          _recargarTabla("#dt-datos");
                        });
                    });//Funcion en caso de guardar correctamente);
}

function aprobar(id)
{
  _mostrarFormulario("/dashboard/obras/"+id+"/aprobar/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-aprobar", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-obras", //ID del Formulario
                  "#carga-aprobar", //Loading de guardar datos de formulario
                  "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(respuesta){

                    _ocultarModal("#modal-aprobar", function(){
                      _recargarTabla("#dt-datos");
                    });

                    setTimeout(function() {
                      location.href   =   "/dashboard/obras/" + respuesta.id;
                    }, 500);
                    
                  });//Funcion en caso de guardar correctamente);
}

function rechazar(id)
{
  _mostrarFormulario("/dashboard/obras/"+id+"/rechazar/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-rechazar", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-obras", //ID del Formulario
                  "#carga-rechazar", //Loading de guardar datos de formulario
                  "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-rechazar", function(){
                      _recargarTabla("#dt-datos");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/dashboard/obras/"+id+"/eliminar/", //Url solicitud de datos
                  "#modal-1", //Div que contendra el modal
                  "#modal-eliminar", //Nombre modal
                  "", //Elemento al que se le dara focus una vez cargado el modal
                  function(){

                  }, //Funcion para el success
                  "#form-obras", //ID del Formulario
                  "#carga-eliminar", //Loading de guardar datos de formulario
                  "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                  function(){
                    _ocultarModal("#modal-eliminar", function(){
                      _recargarTabla("#dt-datos");
                    });
                  });//Funcion en caso de guardar correctamente);
}

function comportamientoTipoBienCultural(id){
  // Obtenemos el option del id seleccionado
  var   option  =   $("#tipo-bien-cultural-" + id);

  // Guardamos en un input si se calcula la temporalidad o no
  // Se necesitara en el controlador
  $("#calcular-temporalidad").val(option.attr('calcular-temporalidad'));

  // Si el atributo calcular-temporalidad del option es si entonces mostramos el div de temporalidad y cultura
  // Si no mostramos el div de epoca y autor
  if(option.attr('calcular-temporalidad') == "si"){
    $("#div-temporalidad").removeClass('hidden');
    $("#div-cultura").removeClass('hidden');

    $("#div-epoca").addClass('hidden');
    $("#div-autor").addClass('hidden');
  } else{
    $("#div-epoca").removeClass('hidden');
    $("#div-autor").removeClass('hidden');

    $("#div-temporalidad").addClass('hidden');
    $("#div-cultura").addClass('hidden');
  }
}

function comportamientoStatusEpoca(id){
  // Si el status es confirmado entonces mostramos el div de epoca
  // Si no entonces lo ocultamos
  if(id == "Confirmado"){
    $("#div-año").removeClass('hidden');
  }else{
    $("#div-año").addClass('hidden');
  }
}