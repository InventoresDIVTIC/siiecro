<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nombre'      	=>  "Director Académico",
            'descripcion'   =>  "Director académico de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Director General",
            'descripcion' 	=>  "Director general de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Secretaria",
            'descripcion' 	=>  "Secretaria general de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Seminarios-Taller",
            'descripcion' 	=>  "Seminarios-Taller de Restauración y Conservación",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Laboratorios",
            'descripcion' 	=>  "Laboratoristas de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Alumno",
            'descripcion' 	=>  "Alumno de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Maestro de Restauración",
            'descripcion' 	=>  "Maestro del STR",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Asesor Cientifico",
            'descripcion' 	=>  "Asesor científico de la ECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'      	=>  "Servicio Social SIIECRO",
            'descripcion' 	=>  "Prestador de servicio Social del SIIECRO",
        ]);
        DB::table('roles')->insert([
            'nombre'                                =>  "Administrador",
            'descripcion' 	                        =>  "Administrador de la sistema del SIIECRO",
            'captura_solicitud_obra'                =>  "1",
            'captura_de_responsables_intervencion'  =>  "1",
            'captura_de_catalogos_basica'           =>  "1",
            'captura_de_catalogos_avanzada'         =>  "1",
            'captura_de_solicitud_analisis'         =>  "1",
            'captura_de_resultados'                 =>  "1",
            'edicion_de_registro_basica'            =>  "1",
            'edicion_de_registro_avanzada_1'        =>  "1",
            'edicion_de_registro_avanzada_2'        =>  "1",
            'eliminar_solicitud_obra'               =>  "1",
            'eliminar_registro'                     =>  "1",
            'eliminar_solicitud_analisis'           =>  "1",
            'eliminar_resultados'                   =>  "1",
            'eliminar_catalogos'                    =>  "1",
            'acceso_a_lista_solicitudes_analisis'   =>  "1",
            'acceso_a_lista_solicitudes_obras'      =>  "1",
            'acceso_a_datos_basico'                 =>  "1",
            'acceso_a_datos_avanzado'               =>  "1",
            'consulta_general_basica'               =>  "1",
            'consulta_general_avanzada'             =>  "1",
            'consulta_externa'                      =>  "1",
            'consulta_estadistica'                  =>  "1",
            'imprimir_condicionado'                 =>  "1",
            'imprimir_oficios'                      =>  "1",
            'creacion_usuarios_permisos'            =>  "1",
            'administrar_solicitudes_obras'         =>  "1",
            'administrar_solicitudes_analisis'      =>  "1",
            'administrar_registro_resultados'       =>  "1"
        ]);
        DB::table('roles')->insert([
            'nombre'        =>  "Externo",
            'descripcion'   =>  "Usuario externo al sistema SIIECRO",
        ]);
    }
}
