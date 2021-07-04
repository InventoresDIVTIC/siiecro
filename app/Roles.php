<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	protected $table = "roles";
    protected $fillable = [
    	'id',
        'nombre',
        'descripcion',
        
        'captura_solicitud_obra',
        'captura_de_responsables_intervencion',
        'captura_de_catalogos_basica',
        'captura_de_catalogos_avanzada',
        'captura_de_solicitud_analisis',
        'captura_de_resultados',

        'edicion_de_registro_basica',
        'edicion_de_registro_avanzada_1',
        'edicion_de_registro_avanzada_2',
        
        'eliminar_solicitud_obra',
        'eliminar_registro',
        'eliminar_solicitud_analisis',
        'eliminar_resultados',
        'eliminar_catalogos',
        
        'acceso_a_lista_solicitudes_analisis',
        'acceso_a_lista_solicitudes_obras',
        'acceso_a_datos_basico',
        'acceso_a_datos_avanzado',
        
        'consulta_general_basica',
        'consulta_general_avanzada',
        'consulta_externa',
        'consulta_estadistica',

        'imprimir',
        'imprimir_oficios',

        'creacion_usuarios_permisos',
        'administrar_solicitudes_obras',
        'administrar_solicitudes_analisis',
        'administrar_registro_resultados',
    ];

    public function esExterno(){
        if (
                $this->captura_solicitud_obra                   ||
                $this->captura_de_responsables_intervencion     ||
                $this->captura_de_catalogos_basica              ||
                $this->captura_de_catalogos_avanzada            ||
                $this->captura_de_solicitud_analisis            ||
                $this->captura_de_resultados                    ||
                $this->edicion_de_registro_basica               ||
                $this->edicion_de_registro_avanzada_1           ||
                $this->edicion_de_registro_avanzada_2           ||
                $this->eliminar_solicitud_obra                  ||
                $this->eliminar_registro                        ||
                $this->eliminar_solicitud_analisis              ||
                $this->eliminar_resultados                      ||
                $this->eliminar_catalogos                       ||
                $this->acceso_a_lista_solicitudes_analisis      ||
                $this->acceso_a_lista_solicitudes_obras         ||
                $this->acceso_a_datos_basico                    ||
                $this->acceso_a_datos_avanzado                  ||
                $this->consulta_general_basica                  ||
                $this->consulta_general_avanzada                ||
                $this->consulta_externa                         ||
                $this->consulta_estadistica                     ||
                $this->imprimir                                 ||
                $this->imprimir_oficios                         ||
                $this->creacion_usuarios_permisos               ||
                $this->administrar_solicitudes_obras            ||
                $this->administrar_solicitudes_analisis         ||
                $this->administrar_registro_resultados
            ){
            return false;
        }

        return true;
    }
}
