<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (
                    Auth::user()->rol->captura_solicitud_obra                   ||
                    Auth::user()->rol->captura_de_responsables_intervencion     ||
                    Auth::user()->rol->captura_de_catalogos_basica              ||
                    Auth::user()->rol->captura_de_catalogos_avanzada            ||
                    Auth::user()->rol->captura_de_solicitud_analisis            ||
                    Auth::user()->rol->captura_de_resultados                    ||
                    Auth::user()->rol->edicion_de_registro_basica               ||
                    Auth::user()->rol->edicion_de_registro_avanzada_1           ||
                    Auth::user()->rol->edicion_de_registro_avanzada_2           ||
                    Auth::user()->rol->eliminar_solicitud_obra                  ||
                    Auth::user()->rol->eliminar_registro                        ||
                    Auth::user()->rol->eliminar_solicitud_analisis              ||
                    Auth::user()->rol->eliminar_resultados                      ||
                    Auth::user()->rol->eliminar_catalogos                       ||
                    Auth::user()->rol->acceso_a_lista_solicitudes_analisis      ||
                    Auth::user()->rol->acceso_a_lista_solicitudes_obras         ||
                    Auth::user()->rol->acceso_a_datos_basico                    ||
                    Auth::user()->rol->acceso_a_datos_avanzado                  ||
                    Auth::user()->rol->consulta_general_basica                  ||
                    Auth::user()->rol->consulta_general_avanzada                ||
                    Auth::user()->rol->consulta_externa                         ||
                    Auth::user()->rol->consulta_estadistica                     ||
                    Auth::user()->rol->imprimir                                 ||
                    Auth::user()->rol->imprimir_oficios                         ||
                    Auth::user()->rol->creacion_usuarios_permisos               ||
                    Auth::user()->rol->administrar_solicitudes_obras            ||
                    Auth::user()->rol->administrar_solicitudes_analisis         ||
                    Auth::user()->rol->administrar_registro_resultados
                ) {
                return $next($request);
            } else{
                return redirect()->route('consulta.index');
            }
        } else{
            return redirect()->route('landing.index');
        }
        
    }
}
