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


	Route::prefix('dashboard')->namespace('Dashboard')->name('dashboard.')->middleware(['VerDashboard'])->group(function () {
	    Route::get('/clear-cache', function() {
			$exitCode = Artisan::call('cache:clear');
			return 'cache cleared';
		});
	    ######## DASHBOARD ##############################################################
			Route::get('/', 									'DashboardController@index')->name('dashboard.index');
			Route::get('/grafica-obras-bienes-culturales', 		'DashboardController@graficasObrasBienesCulturales');
			Route::get('/grafica-obras-tipos-objeto', 			'DashboardController@graficasObrasTiposObjeto');
			Route::get('/grafica-obras-areas', 					'DashboardController@graficasObrasAreas');
			Route::get('/tabla-obras', 							'DashboardController@tablaObras');
			Route::get('/tabla-solicitudes', 					'DashboardController@tablaSolicitudesAnalisis');
			Route::get('/tabla-resultados', 					'DashboardController@tablaResultadosAnalisis');
		#################################################################################

	    ######## Configuraciones ##############################################################
			Route::resource('configuraciones', 			'ConfiguracionesController');
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
			Route::get('proyectos/seeder', 			'ProyectosController@seeder');
			Route::get('proyectos/{id}/eliminar', 	'ProyectosController@eliminar');
			Route::resource('proyectos', 			'ProyectosController');

			##### TEMPORADAS DE TRABAJO #################################################
				Route::get('proyectos/temporadas-trabajo/carga/{proyecto_id}', 			'ProyectosTemporadasTrabajoController@cargarTabla');
				Route::get('proyectos/temporadas-trabajo/{id}/eliminar', 				'ProyectosTemporadasTrabajoController@eliminar');
				Route::get('proyectos/temporadas-trabajo/create/{proyecto_id}', 		'ProyectosTemporadasTrabajoController@create');
				Route::get('proyectos/temporadas-trabajo/select2', 						'ProyectosTemporadasTrabajoController@select2');
				Route::get('proyectos/temporadas-trabajo/imprimir-entrada/{id}', 		'ProyectosTemporadasTrabajoController@imprimirEntrada')->name('temporadas-trabajo.imprimir-entrada');
				Route::get('proyectos/temporadas-trabajo/imprimir-salida/{id}', 		'ProyectosTemporadasTrabajoController@imprimirSalida')->name('temporadas-trabajo.imprimir-salida');
				Route::get('proyectos/temporadas-trabajo/seeder', 						'ProyectosTemporadasTrabajoController@seeder');
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
			Route::get('obras/{id}/deshabilitar', 					'ObrasController@deshabilitar');
			Route::get('obras/{id}/habilitar', 						'ObrasController@habilitar');
			Route::get('obras/{id}/eliminar', 						'ObrasController@eliminar');
			Route::get('obras/{id}/aprobar', 						'ObrasController@modalAprobar');
			Route::put('obras/{id}/aprobar', 						'ObrasController@aprobar')->name('obras.aprobar');
			Route::get('obras/{id}/rechazar', 						'ObrasController@modalRechazar');
			Route::put('obras/{id}/rechazar', 						'ObrasController@rechazar')->name('obras.rechazar');
			Route::get('obras/importar', 							'ObrasController@modalImportar');
			Route::put('obras/importar', 							'ObrasController@importar')->name('obras.importar');
			Route::get('obras/exportar/{mostrar_ids}', 				'ObrasController@exportar')->name('obras.exportar');
			Route::get('obras/imprimir/{id}', 						'ObrasController@imprimir')->name('obras.imprimir');
			Route::get('obras/imprimir-oficio/{id}', 				'ObrasController@imprimirOficio')->name('obras.imprimir-oficio');
			Route::get('obras/imprimir-oficio-salida/{id}', 		'ObrasController@imprimirOficioSalida')->name('obras.imprimir-oficio-salida');
			Route::resource('obras', 								'ObrasController');

			#### OBRAS IMAGENES #########################################################
				Route::post('obras-imagenes-principales/{id}/subir-imagen', 		'ObrasController@subirImagenPrincipal');
				Route::get('obras-imagenes-principales/{id}/eliminar-imagen', 		'ObrasController@alertaEliminarImagenPrincipal');
				Route::delete('obras-imagenes-principales/{id}/eliminar-imagen', 	'ObrasController@eliminarImagenPrincipal')->name('obras.eliminar-imagen-principal');
				Route::get('obras-imagenes-principales/{id}/ver-imagenes', 			'ObrasController@verImagenesPrincipales');
			#############################################################################

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
			Route::get('resultados-analisis/interpretaciones-particulares/select2',			'ObrasResultadosAnalisisController@interpretacionesParticularesSelect2');

			// RESULTADOS ANALITICOS
			Route::get('resultados-analisis/carga-analisis-realizar-resultados/{id}', 		'ObrasResultadosAnalisisController@cargarAnalisisRealizarResultados');
			
			Route::get('resultados-analisis/crear-resultado-analitico', 					'ObrasResultadosAnalisisController@crearResultadoAnalitico');
			Route::post('resultados-analisis/guardar-resultado-analitico', 					'ObrasResultadosAnalisisController@guardarResultadoAnalitico')->name('resultados-analisis.guardar-resultado-analitico');
			Route::get('resultados-analisis/editar-resultado-analitico/{id}', 				'ObrasResultadosAnalisisController@editarResultadoAnalitico');
			Route::put('resultados-analisis/actualizar-resultado-analitico/{id}', 			'ObrasResultadosAnalisisController@actualizarResultadoAnalitico')->name('resultados-analisis.actualizar-resultado-analitico');
			Route::get('resultados-analisis/aviso-eliminar-resultado-analitico/{id}', 		'ObrasResultadosAnalisisController@avisoEliminarResultadoAnalitico');
			Route::delete('resultados-analisis/destruir-resultado-analitico/{id}', 			'ObrasResultadosAnalisisController@destruirResultadoAnalitico')->name('resultados-analisis.destruir-resultado-analitico');
			Route::get('resultados-analisis/informacion-por-definir/select2',				'ObrasResultadosAnalisisController@informacionPorDefinirSelect2');
			Route::get('resultados-analisis/tecnica-analitica/select2',						'ObrasResultadosAnalisisController@tecnicaAnaliticaSelect2');
			
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
			Route::get('obras-tipo-bien-cultural/cargar-terminos-relacionados/{id_tipo_bien_cultural}', 'ObrasTipoBienCulturalController@cargarTerminosRelacionados');
			Route::get('obras-tipo-bien-cultural/crear-terminos-relacionados',							'ObrasTipoBienCulturalController@crearTerminosRelacionados');
			Route::post('obras-tipo-bien-cultural/guardar-terminos-relacionados', 						'ObrasTipoBienCulturalController@guardarTerminosRelacionados')->name('obras-tipo-bien-cultural.guardar-terminos-relacionados');
			Route::get('obras-tipo-bien-cultural/editar-terminos-relacionados/{id}', 					'ObrasTipoBienCulturalController@editarTerminosRelacionados');
			Route::put('obras-tipo-bien-cultural/actualizar-terminos-relacionados/{id}', 				'ObrasTipoBienCulturalController@actualizarTerminosRelacionados')->name('obras-tipo-bien-cultural.actualizar-terminos-relacionados');
			Route::get('obras-tipo-bien-cultural/aviso-eliminar-terminos-relacionados/{id}', 			'ObrasTipoBienCulturalController@avisoEliminarTerminosRelacionados');
			Route::delete('obras-tipo-bien-cultural/destruir-terminos-relacionados/{id}', 				'ObrasTipoBienCulturalController@destruirTerminosRelacionados')->name('obras-tipo-bien-cultural.destruir-terminos-relacionados');

			Route::get('obras-tipo-bien-cultural/carga', 			'ObrasTipoBienCulturalController@cargarTabla');
			Route::get('obras-tipo-bien-cultural/{id}/eliminar', 	'ObrasTipoBienCulturalController@eliminar');
			Route::resource('obras-tipo-bien-cultural', 			'ObrasTipoBienCulturalController');
		#################################################################################

	    ######## OBRAS TIPO OBJETO ######################################################
			Route::get('obras-tipo-objeto/cargar-terminos-relacionados/{id_tipo_objeto}', 		'ObrasTipoObjetoController@cargarTerminosRelacionados');
			Route::get('obras-tipo-objeto/crear-terminos-relacionados',							'ObrasTipoObjetoController@crearTerminosRelacionados');
			Route::post('obras-tipo-objeto/guardar-terminos-relacionados', 						'ObrasTipoObjetoController@guardarTerminosRelacionados')->name('obras-tipo-objeto.guardar-terminos-relacionados');
			Route::get('obras-tipo-objeto/editar-terminos-relacionados/{id}', 					'ObrasTipoObjetoController@editarTerminosRelacionados');
			Route::put('obras-tipo-objeto/actualizar-terminos-relacionados/{id}', 				'ObrasTipoObjetoController@actualizarTerminosRelacionados')->name('obras-tipo-objeto.actualizar-terminos-relacionados');
			Route::get('obras-tipo-objeto/aviso-eliminar-terminos-relacionados/{id}', 			'ObrasTipoObjetoController@avisoEliminarTerminosRelacionados');
			Route::delete('obras-tipo-objeto/destruir-terminos-relacionados/{id}', 				'ObrasTipoObjetoController@destruirTerminosRelacionados')->name('obras-tipo-objeto.destruir-terminos-relacionados');

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
			Route::get('obras-tipo-de-material/carga', 											'ObrasTipoDeMaterialController@cargarTabla');
			Route::get('obras-tipo-de-material/{id}/eliminar', 									'ObrasTipoDeMaterialController@eliminar');
			
			Route::get('obras-tipo-de-material/cargar-interpretaciones/{id_tipo_material}', 	'ObrasTipoDeMaterialController@cargarInterpretacionesCruzadas');
			Route::get('obras-tipo-de-material/crear-interpretacion-cruzada/{id_tipo_material}','ObrasTipoDeMaterialController@crearInterpretacionCruzada');
			Route::post('obras-tipo-de-material/guardar-interpretacion-cruzada', 				'ObrasTipoDeMaterialController@guardarInterpretacionCruzada')->name('obras-tipo-de-material.guardar-interpretacion-cruzada');
			Route::get('obras-tipo-de-material/editar-interpretacion-cruzada/{id}', 			'ObrasTipoDeMaterialController@editarInterpretacionCruzada');
			Route::put('obras-tipo-de-material/actualizar-interpretacion-cruzada/{id}', 		'ObrasTipoDeMaterialController@actualizarInterpretacionCruzada')->name('obras-tipo-de-material.actualizar-interpretacion-cruzada');
			Route::get('obras-tipo-de-material/aviso-eliminar-interpretacion-cruzada/{id}', 	'ObrasTipoDeMaterialController@avisoEliminarInterpretacionCruzada');
			Route::delete('obras-tipo-de-material/destruir-interpretacion-cruzada/{id}', 		'ObrasTipoDeMaterialController@destruirInterpretacionCruzada')->name('obras-tipo-de-material.destruir-interpretacion-cruzada');

			Route::get('obras-tipo-de-material/cargar-informaciones/{id_tipo_material}', 		'ObrasTipoDeMaterialController@cargarInformacionesCruzadas');
			Route::get('obras-tipo-de-material/crear-informacion-cruzada/{id_tipo_material}',	'ObrasTipoDeMaterialController@crearInformacionCruzada');
			Route::post('obras-tipo-de-material/guardar-informacion-cruzada', 					'ObrasTipoDeMaterialController@guardarInformacionCruzada')->name('obras-tipo-de-material.guardar-informacion-cruzada');
			Route::get('obras-tipo-de-material/editar-informacion-cruzada/{id}', 				'ObrasTipoDeMaterialController@editarInformacionCruzada');
			Route::put('obras-tipo-de-material/actualizar-informacion-cruzada/{id}', 			'ObrasTipoDeMaterialController@actualizarInformacionCruzada')->name('obras-tipo-de-material.actualizar-informacion-cruzada');
			Route::get('obras-tipo-de-material/aviso-eliminar-informacion-cruzada/{id}', 		'ObrasTipoDeMaterialController@avisoEliminarInformacionCruzada');
			Route::delete('obras-tipo-de-material/destruir-informacion-cruzada/{id}', 			'ObrasTipoDeMaterialController@destruirInformacionCruzada')->name('obras-tipo-de-material.destruir-informacion-cruzada');

			Route::get('obras-tipo-de-material/cargar-terminos-relacionados/{id_tipo_material}','ObrasTipoDeMaterialController@cargarTerminosRelacionados');
			Route::get('obras-tipo-de-material/crear-terminos-relacionados',					'ObrasTipoDeMaterialController@crearTerminosRelacionados');
			Route::post('obras-tipo-de-material/guardar-terminos-relacionados', 				'ObrasTipoDeMaterialController@guardarTerminosRelacionados')->name('obras-tipo-de-material.guardar-terminos-relacionados');
			Route::get('obras-tipo-de-material/editar-terminos-relacionados/{id}', 				'ObrasTipoDeMaterialController@editarTerminosRelacionados');
			Route::put('obras-tipo-de-material/actualizar-terminos-relacionados/{id}', 			'ObrasTipoDeMaterialController@actualizarTerminosRelacionados')->name('obras-tipo-de-material.actualizar-terminos-relacionados');
			Route::get('obras-tipo-de-material/aviso-eliminar-terminos-relacionados/{id}', 		'ObrasTipoDeMaterialController@avisoEliminarTerminosRelacionados');
			Route::delete('obras-tipo-de-material/destruir-terminos-relacionados/{id}', 		'ObrasTipoDeMaterialController@destruirTerminosRelacionados')->name('obras-tipo-de-material.destruir-terminos-relacionados');

			Route::resource('obras-tipo-de-material', 											'ObrasTipoDeMaterialController');
		#################################################################################

	    ######## OBRAS INFORMACIÓN POR DEFINIR ##########################################
			Route::get('obras-informacion-por-definir/carga', 			'ObrasTipoMaterialInformacionPorDefinirController@cargarTabla');
			Route::get('obras-informacion-por-definir/{id}/eliminar', 	'ObrasTipoMaterialInformacionPorDefinirController@eliminar');
			Route::resource('obras-informacion-por-definir', 			'ObrasTipoMaterialInformacionPorDefinirController');
		#################################################################################

	    ######## OBRAS INTERPRETACIÓN PARTICULAR RENOMBRADA A INTERPRETACIÓN MATERIAL ###
			Route::get('obras-interpretacion-particular/cargar-terminos-relacionados/{id_interpretacion_particular}',	'ObrasTipoMaterialInterpretacionParticularController@cargarTerminosRelacionados');
			Route::get('obras-interpretacion-particular/crear-terminos-relacionados',									'ObrasTipoMaterialInterpretacionParticularController@crearTerminosRelacionados');
			Route::post('obras-interpretacion-particular/guardar-terminos-relacionados', 								'ObrasTipoMaterialInterpretacionParticularController@guardarTerminosRelacionados')->name('obras-interpretacion-particular.guardar-terminos-relacionados');
			Route::get('obras-interpretacion-particular/editar-terminos-relacionados/{id}', 							'ObrasTipoMaterialInterpretacionParticularController@editarTerminosRelacionados');
			Route::put('obras-interpretacion-particular/actualizar-terminos-relacionados/{id}', 						'ObrasTipoMaterialInterpretacionParticularController@actualizarTerminosRelacionados')->name('obras-interpretacion-particular.actualizar-terminos-relacionados');
			Route::get('obras-interpretacion-particular/aviso-eliminar-terminos-relacionados/{id}', 					'ObrasTipoMaterialInterpretacionParticularController@avisoEliminarTerminosRelacionados');
			Route::delete('obras-interpretacion-particular/destruir-terminos-relacionados/{id}', 						'ObrasTipoMaterialInterpretacionParticularController@destruirTerminosRelacionados')->name('obras-interpretacion-particular.destruir-terminos-relacionados');

			Route::get('obras-interpretacion-particular/carga', 														'ObrasTipoMaterialInterpretacionParticularController@cargarTabla');
			Route::get('obras-interpretacion-particular/{id}/eliminar', 												'ObrasTipoMaterialInterpretacionParticularController@eliminar');
			Route::resource('obras-interpretacion-particular', 															'ObrasTipoMaterialInterpretacionParticularController');
		#################################################################################

	    ######## OBRAS ANÁLISIS A REALIZAR ##############################################
			Route::get('obras-analisis-a-realizar/carga', 							'ObrasAnalisisARealizarController@cargarTabla');
			Route::get('obras-analisis-a-realizar/{id}/eliminar', 					'ObrasAnalisisARealizarController@eliminar');
			
			Route::get('obras-analisis-a-realizar/cargar-tecnicas/{id_analisis}', 	'ObrasAnalisisARealizarController@cargarTecnicas');
			Route::get('obras-analisis-a-realizar/crear-tecnica', 					'ObrasAnalisisARealizarController@crearTecnica');
			Route::post('obras-analisis-a-realizar/guardar-tecnica', 				'ObrasAnalisisARealizarController@guardarTecnica')->name('obras-analisis-a-realizar.guardar-tecnica');
			Route::get('obras-analisis-a-realizar/editar-tecnica/{id}', 			'ObrasAnalisisARealizarController@editarTecnica');
			Route::put('obras-analisis-a-realizar/actualizar-tecnica/{id}', 		'ObrasAnalisisARealizarController@actualizarTecnica')->name('obras-analisis-a-realizar.actualizar-tecnica');
			Route::get('obras-analisis-a-realizar/aviso-eliminar-tecnica/{id}', 	'ObrasAnalisisARealizarController@avisoEliminarTecnica');
			Route::delete('obras-analisis-a-realizar/destruir-tecnica/{id}', 		'ObrasAnalisisARealizarController@destruirTecnica')->name('obras-analisis-a-realizar.destruir-tecnica');

			Route::resource('obras-analisis-a-realizar', 							'ObrasAnalisisARealizarController');
		#################################################################################

	    ######## OBRAS INFORMACIÓN DEL EQUIPO ###########################################
			Route::get('obras-informacion-del-equipo/carga', 			'ObrasAnalisisARealizarInformacionDelEquipoController@cargarTabla');
			Route::get('obras-informacion-del-equipo/{id}/eliminar', 	'ObrasAnalisisARealizarInformacionDelEquipoController@eliminar');
			Route::resource('obras-informacion-del-equipo', 			'ObrasAnalisisARealizarInformacionDelEquipoController');
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
			Route::get('/', 			'IndexController@index')->name('landing.index');
			Route::get('/creditos', 	'IndexController@creditos')->name('landing.creditos');
		#################################################################################

	    ######## CONSULTA ###############################################################
			Route::get('/consulta', 	'ConsultaController@index')->name('consulta.index');
			Route::post('/consulta', 	'ConsultaController@busqueda')->name('consulta.buscar');
			Route::post('/filtrado', 	'ConsultaController@filtrado')->name('consulta.filtrado');

			// ESTA RUTA LA DEJO DE MUESTRA SIN COMENTAR PARA QUE VEAS COMO LA UTILICÉ 
			// POR SI ACASO TE SIRVE VIEJÓN, IGUAL LA PUEDES BORRAR CUANDO CREAS CONVENIENTE
			Route::get('/consulta-obra/{id_obra}', 	'ConsultaController@obtenerObrasRecomendadas');

			##### DETALLE ###############################################################
				Route::get('/consulta/{seo}', 	'ConsultaController@detalle')->name('consulta.detalle');
			#############################################################################
		#################################################################################

	    ######## CONTACTO ###############################################################
			Route::get('/contacto', 	'ContactoController@index')->name('contacto.index');
			Route::put('/contacto', 	'ContactoController@contacto')->name('contacto.contacto');
		#################################################################################
	});

#########################################################################
# 						FIN RUTAS LANDING 								#
#########################################################################
