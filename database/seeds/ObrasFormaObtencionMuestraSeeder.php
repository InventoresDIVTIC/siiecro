<?php

use Illuminate\Database\Seeder;

class ObrasFormaObtencionMuestraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Raspado",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Cortes profundos",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Disgregados",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Desprendimiento (contextualizado)",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Láminas delgadas",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Láminas de metales",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'      	=>  "Cortes longitudinales",
        ]);
        DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'        =>  "Hisopo",
        ]);
       DB::table('obras__forma_obtencion_muestra')->insert([
            'nombre'        =>  "Ambiente abierto",
        ]);
    }
}
