Dropzone.autoDiscover = false;
var switchery_disponible_consulta = null;
jQuery(document).ready(function($) {
	$("#tipo_bien_cultural_id, #tipo_objeto_id, #temporalidad_id, #epoca_id, #estatus_año, #estatus_epoca, #area_id, #_responsables, #forma_ingreso, #usuario_recibio_id").select2({
        placeholder: "Seleccione una opción"
    });

    $("#modalidad, #proyecto_id").select2();

    $("#año").datepicker({
        language:       'es',
        format:         'yyyy',
        minViewMode:    'years',
        startDate:      '1400',
        endDate:        '2040',
    });

    $("#fecha_ingreso, #fecha_salida").datepicker({
  	     language:       'es',
        format:         'yyyy-mm-dd',
    });

    $('#tipo_bien_cultural_id').on('select2:select', function (e) {
        comportamientoTipoBienCultural(e.params.data.id);
    });

    $('#estatus_epoca').on('select2:select', function (e) {
        comportamientoStatusEpoca(e.params.data.id);
    });

    comportamientoTipoBienCultural($('#tipo_bien_cultural_id').val());
    comportamientoStatusEpoca($('#estatus_epoca').val());

    _llenarSelect2Estatico("#proyecto_id", "/dashboard/proyectos/select2", {
        area_id:        $("#area_id").val(),
        forma_ingreso:  $("#forma_ingreso").val()
    }, false);

    _llenarSelect2Estatico("#_temporadas_trabajo", "/dashboard/proyectos/temporadas-trabajo/select2", {
        proyecto_id:    $("#proyecto_id").val()
    }, false, false);

    _formAjax(
              "#form-general", // Formulario
              "", // Div progreso
              "#div-notificacion-general", // Div notificacion
              function(){
                location.reload();
              }
            );

    _formAjax(
              "#form-datos-identificacion", // Formulario
              "", // Div progreso
              "#div-respuesta-datos-identificacion", // Div notificacion
              function(){
                location.reload();
              }
            );

    $('#area_id').on('select2:select', function (e) {
        inicializarSelect2Proyecto();
    });

    $('#forma_ingreso').on('select2:select', function (e) {
        inicializarSelect2Proyecto();
    });

    $('#proyecto_id').on('select2:select', function (e) {
        comportamientoSelectProyecto();
    });

    $('#proyecto_id').on('select2:unselect', function (e) {
        comportamientoSelectProyecto(true);
    });

    switchery_disponible_consulta   =   new Switchery(document.querySelector('#disponible_consulta'), { color: '#1AB394' });
});

// ID DE LA OBRA 
var id_de_la_obra_actual = $('#id').val();

// console.log(id_de_la_obra_actual);
// recargarImagenesPrincipalesDeObra(id_de_la_obra_actual);
// DROPZONE PARA FOTOGRAFIAS PRINCIPALES DE LA OBRA
$("#dropzone-obra-imagenes-principales").dropzone({ 
  url: "/dashboard/obras-imagenes-principales/" + id_de_la_obra_actual + "/subir-imagen",
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
      // _recargarTabla("#dt-datos-resultados-analisis");
      recargarImagenesPrincipalesDeObra(id_de_la_obra_actual);
    }, 1000);
  }
});

// CARROUSEL DE IMAGENES PRINCIPALES DE LA OBRA
$('#carrusel-obra-imagenes-principales').owlCarousel({
  loop:      false,
  margin:    10,
  nav:       false,
  center:    false,
  items:     4
});

// FUNCIÓN PARA RECARGAR IMÁGENES PRINCIPALES DE LA OBRA CUANDO SE AGREGAN O ELIMINAN MÁS
function recargarImagenesPrincipalesDeObra(obra_id){
  $.ajax({
    url: '/dashboard/obras-imagenes-principales/' + obra_id + '/ver-imagenes',
    type: 'GET',
    success: function(respuesta){
      $("#contenedor-obra-imagenes-principales").html(respuesta);
      $('#carrusel-obra-imagenes-principales').owlCarousel({
        loop:      false,
        margin:    10,
        nav:       false,
        center:    false,
        items:     4
      });
    },
    error: function(){
      _toast("error", "Hubo un error al obtener las imagenes, intenta de nuevo mas tarde");
    }
  });  
}

function eliminarImagenPrincipalDeObra(id, obra_id){
  _mostrarFormulario("/dashboard/obras-imagenes-principales/"+id+"/eliminar-imagen/", //Url solicitud de datos
                      "#modal-1", //Div que contendra el modal
                      "#modal-eliminar-imagen-principal", //Nombre modal
                      "", //Elemento al que se le dara focus una vez cargado el modal
                      function(){

                      }, //Funcion para el success
                      "#form-eliminar-imagen-principal", //ID del Formulario
                      "", //Loading de guardar datos de formulario
                      "#div-notificacion-imagen-principal", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                      function(){
                        _ocultarModal("#modal-eliminar-imagen-principal", function(){
                          // _recargarTabla("#dt-datos-analisis-realizar-resultados");
                          recargarImagenesPrincipalesDeObra(obra_id);
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

function toggleEdicionDatosGenerales(estatus){
  // True: Habilitar edicion
  // False: Deshabilitar edicion
  if(estatus){
    $("#form-general").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', false);
    $("#btn-group-habilitar-edicion").addClass('hidden');
    $("#btn-group-editar").removeClass('hidden');
    $("#dropzone-imagenes-principales-ocultas").removeClass('hidden');
  } else{
    $("#form-general").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', true);
    $("#btn-group-habilitar-edicion").removeClass('hidden');
    $("#btn-group-editar").addClass('hidden');
    $("#dropzone-imagenes-principales-ocultas").addClass('hidden');
  }
}

function toggleEdicionDatosIdentificacion(estatus){
  // True: Habilitar edicion
  // False: Deshabilitar edicion
  if(estatus){
    $("#form-datos-identificacion").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', false);
    $("#btn-group-habilitar-edicion-datos-identificacion").addClass('hidden');
    $("#btn-group-editar-datos-identificacion").removeClass('hidden');
  } else{
    $("#form-datos-identificacion").find('input:not([no-editar]), textarea:not([no-editar]), select:not([no-editar])').attr('disabled', true);
    $("#btn-group-habilitar-edicion-datos-identificacion").removeClass('hidden');
    $("#btn-group-editar-datos-identificacion").addClass('hidden');
  }
}

function inicializarSelect2Proyecto(limpiar = true){
    $("#div-proyecto").removeClass('hidden');
    _llenarSelect2Estatico("#proyecto_id", "/dashboard/proyectos/select2", {
        area_id:        $("#area_id").val(),
        forma_ingreso:  $("#forma_ingreso").val()
    }, limpiar);
    comportamientoSelectProyecto(true);
}

function comportamientoSelectProyecto(ocultar = false, limpiar = true){
    if(ocultar){
        $("#div-temporadas-trabajo").addClass('hidden');
        $("#_temporadas_trabajo").empty().trigger("change");
    } else{
        $("#div-temporadas-trabajo").removeClass('hidden');
        _llenarSelect2Estatico("#_temporadas_trabajo", "/dashboard/proyectos/temporadas-trabajo/select2", {
            proyecto_id:    $("#proyecto_id").val()
        }, limpiar, false);
    }
}

function cambiarEstatusObra(obra_id){
  $.ajax({
    url: '/dashboard/obras/' + obra_id,
    type: 'PUT',
    data: {
      disponible_consulta:  switchery_disponible_consulta.isChecked() ? 1 : 0,
      _token:               $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response){
      if (response.error) {
        _toast("error", response.mensaje, "Ocurrio un error al cambiar el estatus.");
      } else{
        _toast("exito", "Estatus actualizado con éxito.");
      }
    },
    error: function(){
      alert("Ocurrio un error intenta de nuevo mas tardee");
    }
  })
}