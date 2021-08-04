<?php

use Illuminate\Database\Seeder;

class ObrasTemporalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Preclásico (2500 a.C. a 200 d.C.)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Clásico (200d.C. a 900 d.C.)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Postclásico (900d.C. a 1521 d.C.)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Preclásico tardío/Clásico temprano",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'      	=>  "Fase Teochitlán (450-650 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "N/D",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "750 a.C - 850 a.C",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "800 d.C - 900 d.",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Sayula, Complejo Cojumatlán polícromo (800 d....",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Cojumatlán polícromo",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "350 a.C - 100 d.C",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Amacueca tardía",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "600 d.C - 900 d.C",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Postclásico tardío (1200 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Preclásico medio",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Mitad del periodo formativo temprano (1700 a.C-1500 a.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "400 d.C - 600 d.C",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Clásico tardío (400 d.C- 900 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "200 a.C - 400 d.C",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Clásico temprano (0-300 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase \"El Grillo\"(500 d.C - 900 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Ortíces (300 a.C - 250 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Epiclásico (460 d.C - 900 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Preclásico (70 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Siglo I",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Comala (250- 500 d.C)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Arenal (Preclásico tardío)",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Fase Colima, Clásico tardío/ Epiclásico",
        ]);
        DB::table('obras__temporalidad')->insert([
            'nombre'        =>  "Periodo Terminal (200 a.C-250 a.C)",
        ]);
    }
}
