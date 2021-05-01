<?php

use Illuminate\Database\Seeder;

class ObrasTipoMaterialInformacionPorDefinirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Morfología",
        ]);
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Composición química",
        ]);
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Comportamiento térmico",
        ]);
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Organismos y microorganismos",
        ]);
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Descripción de estratos",
        ]);
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Estado de conservación",
        ]);
        DB::table('obras__tipo_material__informacion_por_definir')->insert([
            'nombre'      	=>  "Estructuras de solidificación",
        ]);
    }
}
