<?php

use Illuminate\Database\Seeder;

class ObrasAnalisisARealizarInformacionDelEquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__analisis_a_realizar_informacion_del_equipo')->insert([
            'nombre'      	=>  "Microscopio Óptico Leica DM750 M",
        ]);

        DB::table('obras__analisis_a_realizar_informacion_del_equipo')->insert([
            'nombre'      	=>  "Pistola Tracer 5i XRF-Bruker Elemental",
        ]);
        
        DB::table('obras__analisis_a_realizar_informacion_del_equipo')->insert([
            'nombre'      	=>  "FTIR ALPHA II",
        ]);
    }
}
