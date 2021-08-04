<?php

use Illuminate\Database\Seeder;

class ObrasTipoObjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Cerámica",
            'color_hexadecimal'     =>  '#3fb5e8',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Textil",
            'color_hexadecimal'     =>  '#7954e3',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Pintura rupestre",
            'color_hexadecimal'     =>  '#de970d',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Pintura mural",
            'color_hexadecimal'     =>  '#db4c1f',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Plafón",
            'color_hexadecimal'     =>  '#188aa3',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Pintura sobre lienzo",
            'color_hexadecimal'     =>  '#9c0912',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Pintura sobre tabla",
            'color_hexadecimal'     =>  '#b39c27',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Técnica mixta",
            'color_hexadecimal'     =>  '#c920c3',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Escultura policromada",
            'color_hexadecimal'     =>  '#ed2d67',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Escultura",
            'color_hexadecimal'     =>  '#2deb84',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Marco",
            'color_hexadecimal'     =>  '#e3d614',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Mueble",
            'color_hexadecimal'     =>  '#fcd23a',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Retablo",
            'color_hexadecimal'     =>  '#8edb0f',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Manuscrito",
            'color_hexadecimal'     =>  '#9f76c7',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Mapa",
            'color_hexadecimal'     =>  '#b012aa',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Plano",
            'color_hexadecimal'     =>  '#ef7bba',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Croquis",
            'color_hexadecimal'     =>  '#917676',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Carta Cartográfica",
            'color_hexadecimal'     =>  '#263fbc',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Cartel",
            'color_hexadecimal'     =>  '#2276f2',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Impresión",
            'color_hexadecimal'     =>  '#843410',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Obra gráfica",
            'color_hexadecimal'     =>  '#d61235',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Fotografía",
            'color_hexadecimal'     =>  '#8eefef',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Instrumento musical",
            'color_hexadecimal'     =>  '#59bc40',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Arma de filo",
            'color_hexadecimal'     =>  '#958f8f',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Arma de fuego",
            'color_hexadecimal'     =>  '#8b1407',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Pintura sobre lámina",
            'color_hexadecimal'     =>  '#a49338',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Mecánico",
            'color_hexadecimal'     =>  '#6f7c90',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Artefacto",
            'color_hexadecimal'     =>  '#146413',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Instrumento científico",
            'color_hexadecimal'     =>  '#1a8d55',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Accesorio para vestir",
            'color_hexadecimal'     =>  '#8b093a',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Medio de cambio",
            'color_hexadecimal'     =>  '#390b60',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "N/A",
            'color_hexadecimal'     =>  '#0c0101',
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'                =>  "Placa",
            'color_hexadecimal'     =>  '#70726e',
        ]);
    }
}
