<?php

use Illuminate\Database\Seeder;

class ObrasTipoBienCulturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Arqueológico",
            'calcular_temporalidad'     =>  'si',
            'color_hexadecimal'         =>  '#f8ce46',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Documental",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#be7cf6',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Histórico",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#297a8b',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Artístico",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#ec186a',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Religioso",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#559dea',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Industrial",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#45b05d',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Etnográfico",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#f7d843',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "N/A",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#fffdfd',
        ]);
        DB::table('obras__tipo_bien_cultural')->insert([
            'nombre'                    =>  "Utilitario",
            'calcular_temporalidad'     =>  'no',
            'color_hexadecimal'         =>  '#a99797',
        ]);
    }
}
