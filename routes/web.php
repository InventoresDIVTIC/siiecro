<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

################ RUTAS DEL DASHBOARD ####################################
# 	Todos los controladores van dentro de la carpeta Dashboard 			#
#	Todas las rutas tendran el prefijo dashboard 						#
#	Todas las rutas tendran el prefijo dashboard. en sus names 			#
#########################################################################


	Route::prefix('dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {
	    ######## DASHBOARD ##############################################################
			Route::get('/', 	'DashboardController@index')->name('dashboard.index');
		#################################################################################
			
	    ######## USUARIOS ###############################################################
			Route::get('usuarios/carga', 			'UsuariosController@cargarTabla');
			Route::get('usuarios/{id}/eliminar', 	'UsuariosController@eliminar');
			Route::get('usuarios/mis-datos', 		'UsuariosController@verMisDatos');
			Route::put('usuarios/mis-datos', 		'UsuariosController@guardarMisDatos')->name('usuarios.mis-datos');
			Route::resource('usuarios', 			'UsuariosController');
		#################################################################################

	    ######## Areas ###############################################################
			Route::get('areas/carga', 			'AreasController@cargarTabla');
			Route::get('areas/{id}/eliminar', 	'AreasController@eliminar');
			Route::resource('areas', 			'AreasController');
		#################################################################################

	    ######## Proyectos ###############################################################
			Route::get('proyectos/carga', 			'ProyectosController@cargarTabla');
			Route::get('proyectos/select2', 		'ProyectosController@select2');
			Route::get('proyectos/{id}/eliminar', 	'ProyectosController@eliminar');
			Route::resource('proyectos', 			'ProyectosController');

			##### TEMPORADAS DE TRABAJO #################################################
				Route::get('proyectos/temporadas-trabajo/carga/{proyecto_id}', 			'ProyectosTemporadasTrabajoController@cargarTabla');
				Route::get('proyectos/temporadas-trabajo/{id}/eliminar', 				'ProyectosTemporadasTrabajoController@eliminar');
				Route::get('proyectos/temporadas-trabajo/create/{proyecto_id}', 		'ProyectosTemporadasTrabajoController@create');
				Route::get('proyectos/temporadas-trabajo/select2', 						'ProyectosTemporadasTrabajoController@select2');
				Route::get('proyectos/temporadas-trabajo/imprimir/{id}', 				'ProyectosTemporadasTrabajoController@imprimir')->name('temporadas-trabajo.imprimir');
				Route::resource('proyectos/temporadas-trabajo', 						'ProyectosTemporadasTrabajoController');
			#############################################################################
		#################################################################################

	    ######## ROLES ##################################################################
			Route::get('roles/carga', 			'RolesController@cargarTabla');
			Route::get('roles/{id}/eliminar', 	'RolesController@eliminar');
			Route::resource('roles', 			'RolesController');
		#################################################################################

	    ######## OBRAS ##################################################################
			Route::get('obras/carga', 								'ObrasController@cargarTabla');
			Route::get('obras/solicitudes-intervencion', 			'ObrasController@solicitudesIntervencion')->name('obras.solicitudes');
			Route::get('obras/solicitudes-intervencion/carga', 		'ObrasController@cargarSolicitudesIntervencion');
			Route::get('obras/{id}/eliminar', 						'ObrasController@eliminar');
			Route::get('obras/{id}/aprobar', 						'ObrasController@modalAprobar');
			Route::put('obras/{id}/aprobar', 						'ObrasController@aprobar')->name('obras.aprobar');
			Route::get('obras/{id}/rechazar', 						'ObrasController@modalRechazar');
			Route::put('obras/{id}/rechazar', 						'ObrasController@rechazar')->name('obras.rechazar');
			Route::get('obras/importar', 							'ObrasController@modalImportar');
			Route::put('obras/importar', 							'ObrasController@importar')->name('obras.importar');
			Route::get('obras/imprimir/{id}', 						'ObrasController@imprimir')->name('obras.imprimir');
			Route::get('obras/imprimir-oficio/{id}', 				'ObrasController@imprimirOficio')->name('obras.imprimir-oficio');
			Route::resource('obras', 								'ObrasController');

			###### OBRAS USUARIOS ASIGNADOS #############################################
				Route::get('obras/usuarios-asignados/carga/{obra_id}', 	'ObrasUsuariosAsignadosController@cargarTabla');
				Route::get('obras/usuarios-asignados/{id}/eliminar', 	'ObrasUsuariosAsignadosController@eliminar');
				Route::get('obras/usuarios-asignados/create/{obra_id}', 'ObrasUsuariosAsignadosController@create');
				Route::resource('obras/usuarios-asignados', 			'ObrasUsuariosAsignadosController');
			#############################################################################

		#################################################################################
	    
	    ######## OBRAS DETALLE SOLICITUD ANALISIS #######################################
			Route::get('solicitudes-analisis/carga/{id}', 									'ObrasSolicitudesAnalisisController@cargarTabla');
			Route::get('solicitudes-analisis/create/{id}', 									'ObrasSolicitudesAnalisisController@create')->name('solicitudes-analisis.create');
			Route::get('solicitudes-analisis/{id}/eliminar', 								'ObrasSolicitudesAnalisisController@eliminar');
			Route::get('solicitudes-analisis/imprimir/{id}', 								'ObrasSolicitudesAnalisisController@imprimir')->name('solicitudes-analisis.imprimir');
			Route::get('solicitudes-analisis/{id}/aprobar-solicitud-analisis', 				'ObrasSolicitudesAnalisisController@modalAprobarSolicitudAnalisis');
			Route::put('solicitudes-analisis/{id}/aprobar-solicitud-analisis', 				'ObrasSolicitudesAnalisisController@aprobarSolicitudAnalisis')->name('obras.aprobar-solicitud-analisis');
			Route::get('solicitudes-analisis/{id}/rechazar-solicitud-analisis', 			'ObrasSolicitudesAnalisisController@modalRechazarSolicitudAnalisis');
			Route::put('solicitudes-analisis/{id}/rechazar-solicitud-analisis', 			'ObrasSolicitudesAnalisisController@rechazarSolicitudAnalisis')->name('obras.rechazar-solicitud-analisis');
			Route::get('solicitudes-analisis/{id}/poner-en-revision-solicitud-analisis', 	'ObrasSolicitudesAnalisisController@modalEnRevisionSolicitudAnalisis');
			Route::put('solicitudes-analisis/{id}/poner-en-revision-solicitud-analisis', 	'ObrasSolicitudesAnalisisController@enRevisionSolicitudAnalisis')->name('obras.poner-en-revision-solicitud-analisis');
			Route::post('solicitudes-analisis/{id}/subir-esquema', 							'ObrasSolicitudesAnalisisController@subirImagenEsquema');
			Route::get('solicitudes-analisis/{id}/eliminar-esquema', 						'ObrasSolicitudesAnalisisController@alertaEliminarEsquema');
			Route::delete('solicitudes-analisis/{id}/eliminar-esquema', 					'ObrasSolicitudesAnalisisController@eliminaresquema')->name('obras.eliminar-esquema-solicitud-analisis');
			Route::get('solicitudes-analisis/{id}/ver-esquema', 							'ObrasSolicitudesAnalisisController@verEsquema');
			
			Route::get('solicitudes-analisis/ver-muestras/{id}', 							'ObrasSolicitudesAnalisisController@verMuestras');
			Route::get('solicitudes-analisis/cargar-muestras/{id}', 						'ObrasSolicitudesAnalisisController@cargarMuestras');
			Route::get('solicitudes-analisis/crear-muestra', 								'ObrasSolicitudesAnalisisController@crearMuestra');
			Route::post('solicitudes-analisis/guardar-muestra', 							'ObrasSolicitudesAnalisisController@guardarMuestra')->name('solicitudes-analisis.guardar-muestra');
			Route::get('solicitudes-analisis/editar-muestra/{id}', 							'ObrasSolicitudesAnalisisController@editarMuestra');
			Route::put('solicitudes-analisis/actualizar-muestra/{id}', 						'ObrasSolicitudesAnalisisController@actualizarMuestra')->name('solicitudes-analisis.actualizar-muestra');
			Route::get('solicitudes-analisis/aviso-eliminar-muestra/{id}', 					'ObrasSolicitudesAnalisisController@avisoEliminarMuestra');
			Route::delete('solicitudes-analisis/destruir-muestra/{id}', 					'ObrasSolicitudesAnalisisController@destruirMuestra')->name('solicitudes-analisis.destruir-muestra');
			
			Route::resource('solicitudes-analisis', 						'ObrasSolicitudesAnalisisController');
		#################################################################################
	    
	    ######## OBRAS DETALLE RESULTADOS ANALISIS #######################################
			Route::post('resultados-analisis/{id}/subir-esquema-muestra', 					'ObrasResultadosAnalisisController@subirImagenEsquemaMuestra');
			Route::get('resultados-analisis/{id}/eliminar-esquema-muestra', 				'ObrasResultadosAnalisisController@alertaEliminarEsquemaMuestra');
			Route::delete('resultados-analisis/{id}/eliminar-esquema-muestra', 				'ObrasResultadosAnalisisController@eliminarEsquemaMuestra')->name('obras.eliminar-esquema-muestra-resultados-analisis');
			Route::get('resultados-analisis/{id}/ver-esquema-muestra', 						'ObrasResultadosAnalisisController@verEsquemaMuestra');
			Route::post('resultados-analisis/{id}/subir-esquema-microfotografia', 			'ObrasResultadosAnalisisController@subirImagenEsquemaMicrofotografia');
			Route::get('resultados-analisis/{id}/eliminar-esquema-microfotografia', 		'ObrasResultadosAnalisisController@alertaEliminarEsquemaMicrofotografia');
			Route::delete('resultados-analisis/{id}/eliminar-esquema-microfotografia', 		'ObrasResultadosAnalisisController@eliminarEsquemaMicrofotografia')->name('obras.eliminar-esquema-microfotografia');
			Route::get('resultados-analisis/{id}/ver-esquema-microfotografia', 				'ObrasResultadosAnalisisController@verEsquemaMicrofotografia');
			Route::get('resultados-analisis/imprimir/{id}', 								'ObrasResultadosAnalisisController@imprimir')->name('resultados-analisis.imprimir');

			// RESULTADOS ANALITICOS
			Route::get('resultados-analisis/carga-analisis-realizar-resultados/{id}', 		'ObrasResultadosAnalisisController@cargarAnalisisRealizarResultados');
			
			Route::get('resultados-analisis/crear-resultado-analitico', 					'ObrasResultadosAnalisisController@crearResultadoAnalitico');
			Route::post('resultados-analisis/guardar-resultado-analitico', 					'ObrasResultadosAnalisisController@guardarResultadoAnalitico')->name('resultados-analisis.guardar-resultado-analitico');
			Route::get('resultados-analisis/editar-resultado-analitico/{id}', 				'ObrasResultadosAnalisisController@editarResultadoAnalitico');
			Route::put('resultados-analisis/actualizar-resultado-analitico/{id}', 			'ObrasResultadosAnalisisController@actualizarResultadoAnalitico')->name('resultados-analisis.actualizar-resultado-analitico');
			Route::get('resultados-analisis/aviso-eliminar-resultado-analitico/{id}', 		'ObrasResultadosAnalisisController@avisoEliminarResultadoAnalitico');
			Route::delete('resultados-analisis/destruir-resultado-analitico/{id}', 			'ObrasResultadosAnalisisController@destruirResultadoAnalitico')->name('resultados-analisis.destruir-resultado-analitico');
			
			// RESULTADOS ANALITICOS MICROFOTOGRAFIA
			Route::post('resultados-analisis/{id}/subir-esquema-analiticos-microfotografia', 		'ObrasResultadosAnalisisController@subirImagenEsquemaAnaliticosMicrofotografia');
			Route::get('resultados-analisis/{id}/eliminar-esquema-analiticos-microfotografia', 		'ObrasResultadosAnalisisController@alertaEliminarEsquemaAnaliticosMicrofotografia');
			Route::delete('resultados-analisis/{id}/eliminar-esquema-analiticos-microfotografia', 	'ObrasResultadosAnalisisController@eliminarEsquemaAnaliticosMicrofotografia')->name('resultados-analisis.eliminar-esquema-analiticos-microfotografia');
			Route::get('resultados-analisis/{id}/ver-esquema-analiticos-microfotografia', 			'ObrasResultadosAnalisisController@verEsquemaAnaliticosMicrofotografia');
			///

			// BITACORA DE APROBACIONES - RECHAZOZ DE RESULTADOS DE ANALISIS
			Route::get('resultados-analisis/{id}/aprobar-resultado-analisis', 				'ObrasResultadosAnalisisController@modalAprobarResultadoAnalisis');
			Route::put('resultados-analisis/{id}/aprobar-resultado-analisis', 				'ObrasResultadosAnalisisController@aprobarResultadoAnalisis')->name('obras.aprobar-resultado-analisis');
			Route::get('resultados-analisis/{id}/rechazar-resultado-analisis', 				'ObrasResultadosAnalisisController@modalRechazarResultadoAnalisis');
			Route::put('resultados-analisis/{id}/rechazar-resultado-analisis', 				'ObrasResultadosAnalisisController@rechazarResultadoAnalisis')->name('obras.rechazar-resultado-analisis');
			Route::get('resultados-analisis/{id}/poner-en-revision-resultado-analisis', 	'ObrasResultadosAnalisisController@modalEnRevisionResultadoAnalisis');
			Route::put('resultados-analisis/{id}/poner-en-revision-resultado-analisis', 	'ObrasResultadosAnalisisController@enRevisionResultadoAnalisis')->name('obras.poner-en-revision-resultado-analisis');
			///
			
			Route::get('resultados-analisis/carga/{id}', 									'ObrasResultadosAnalisisController@cargarTabla');
			Route::get('resultados-analisis/{id}/eliminar', 								'ObrasResultadosAnalisisController@eliminar');
			Route::get('resultados-analisis/crear/{id}/{obra}', 							'ObrasResultadosAnalisisController@crear');
			Route::get('resultados-analisis/editar/{id}/{obra}', 							'ObrasResultadosAnalisisController@editar');
			Route::resource('resultados-analisis', 											'ObrasResultadosAnalisisController');
		#################################################################################
	    
	    ######## OBRAS TIPO BIEN CULTURAL ###############################################
			Route::get('obras-tipo-bien-cultural/carga', 			'ObrasTipoBienCulturalController@cargarTabla');
			Route::get('obras-tipo-bien-cultural/{id}/eliminar', 	'ObrasTipoBienCulturalController@eliminar');
			Route::resource('obras-tipo-bien-cultural', 			'ObrasTipoBienCulturalController');
		#################################################################################

	    ######## OBRAS TIPO OBJETO ######################################################
			Route::get('obras-tipo-objeto/carga', 					'ObrasTipoObjetoController@cargarTabla');
			Route::get('obras-tipo-objeto/{id}/eliminar', 			'ObrasTipoObjetoController@eliminar');
			Route::resource('obras-tipo-objeto', 					'ObrasTipoObjetoController');
		#################################################################################

	    ######## OBRAS EPOCA ############################################################
			Route::get('obras-epoca/carga', 						'ObrasEpocaController@cargarTabla');
			Route::get('obras-epoca/{id}/eliminar', 				'ObrasEpocaController@eliminar');
			Route::resource('obras-epoca', 							'ObrasEpocaController');
		#################################################################################

	    ######## OBRAS TEMPORALIDAD #####################################################
			Route::get('obras-temporalidad/carga', 					'ObrasTemporalidadController@cargarTabla');
			Route::get('obras-temporalidad/{id}/eliminar', 			'ObrasTemporalidadController@eliminar');
			Route::resource('obras-temporalidad', 					'ObrasTemporalidadController');
		#################################################################################

	    ######## OBRAS FORMA OBTENCION DE LA MUESTRA ####################################
			Route::get('obras-forma-obtencion-muestra/carga', 			'ObrasFormaObtencionMuestraController@cargarTabla');
			Route::get('obras-forma-obtencion-muestra/{id}/eliminar', 	'ObrasFormaObtencionMuestraController@eliminar');
			Route::resource('obras-forma-obtencion-muestra', 			'ObrasFormaObtencionMuestraController');
		#################################################################################

	    ######## OBRAS TIPO DE MATERIAL #################################################
			Route::get('obras-tipo-de-material/carga', 					'ObrasTipoDeMaterialController@cargarTabla');
			Route::get('obras-tipo-de-material/{id}/eliminar', 			'ObrasTipoDeMaterialController@eliminar');
			Route::resource('obras-tipo-de-material', 					'ObrasTipoDeMaterialController');
		#################################################################################

	    ######## OBRAS INFORMACIÓN POR DEFINIR ##########################################
			Route::get('obras-informacion-por-definir/carga', 			'ObrasTipoMaterialInformacionPorDefinirController@cargarTabla');
			Route::get('obras-informacion-por-definir/{id}/eliminar', 	'ObrasTipoMaterialInformacionPorDefinirController@eliminar');
			Route::resource('obras-informacion-por-definir', 			'ObrasTipoMaterialInformacionPorDefinirController');
		#################################################################################

	    ######## OBRAS INTERPRETACIÓN PARTICULAR ########################################
			Route::get('obras-interpretacion-particular/carga', 			'ObrasTipoMaterialInterpretacionParticularController@cargarTabla');
			Route::get('obras-interpretacion-particular/{id}/eliminar', 	'ObrasTipoMaterialInterpretacionParticularController@eliminar');
			Route::resource('obras-interpretacion-particular', 				'ObrasTipoMaterialInterpretacionParticularController');
		#################################################################################

	});

#########################################################################
# 						FIN RUTAS DASHBOARD 							#
#########################################################################

################ RUTAS DE LA LANDING ####################################
# 	Todos los controladores van dentro de la carpeta Landing 			#
#########################################################################

	Route::prefix('/')->namespace('Landing')->group(function () {
	    ######## INDEX ##################################################################
			Route::get('/', 	'IndexController@index')->name('landing.index');
		#################################################################################

	    ######## CONSULTA ###############################################################
			Route::get('/consulta', 	'ConsultaController@index')->name('consulta.index');
		#################################################################################

	    ######## CONTACTO ###############################################################
			Route::get('/contacto', 	'ContactoController@index')->name('contacto.index');
		#################################################################################
	});

#########################################################################
# 						FIN RUTAS LANDING 								#
#########################################################################
