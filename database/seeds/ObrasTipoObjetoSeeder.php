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
            'nombre'      	=>  "Cerámica",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Textil",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura rupestre",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'        =>  "Pintura mural",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Plafón",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura sobre lienzo",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura sobre tabla",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Técnica mixta",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Escultura policromada",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Escultura",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Marco",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Mueble",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Retablo",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Manuscrito",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Mapa",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Plano",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Croquis",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Carta Cartográfica",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Cartel",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Impresión",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Obra gráfica",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Fotografía",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'        =>  "Instrumento musical",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Arma de filo",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Arma de fuego",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Pintura sobre lámina",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Mecánico",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Artefacto",
        ]);
        DB::table('obras__tipo_objeto')->insert([
            'nombre'      	=>  "Instrumento científico",
        ]);
    }
}
