<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('areas')->insert(
        	[
        		// Seminario taller de restauracion
	        	[
	            	'nombre'      				=>  "Seminario Taller Restauración Cerámica",
	            	'siglas'      				=>  "STRC",
	            	'color_hexadecimal' 		=> 	"#f3c943",
	        	],
	        	[
	            	'nombre'      				=>  "Seminario Taller Restauración Pintura Mural",
	            	'siglas'      				=>  "STRPM",
	            	'color_hexadecimal' 		=> 	"#b55d1a",
	        	],
	        	[
	            	'nombre'      				=>  "Seminario Taller Restauración Pintura de Caballete",
	            	'siglas'      				=>  "STRPC",
	            	'color_hexadecimal' 		=> 	"#ad171f",
	        	],
	        	[
	            	'nombre'      				=>  "Seminario Taller Restauración Escultura Policromada",
	            	'siglas'      				=>  "STREP",
	            	'color_hexadecimal' 		=> 	"#559dea",
	        	],
	        	[
	            	'nombre'      				=>  "Seminario Taller Restauración Papel y Documentos Gráficos",
	            	'siglas'      				=>  "STRPyDG",
	            	'color_hexadecimal' 		=> 	"#ba7af2",
	        	],
	        	[
	            	'nombre'      				=>  "Seminario Taller Restauración Metales",
	            	'siglas'      				=>  "STRM",
	            	'color_hexadecimal' 		=> 	"#45b05e",
	        	],

	        	// Otros

	        	[
	            	'nombre'      				=>  "Donativo",
	            	'siglas'      				=>  "D",
	            	'color_hexadecimal' 		=> 	"#fb4cb9",
	        	],
	        	[
	            	'nombre'      				=>  "Laboratorio de Química",
	            	'siglas'      				=>  "LQ",
	            	'color_hexadecimal' 		=> 	"#1e0b85",
	        	],
	        	[
	            	'nombre'      				=>  "Titulación",
	            	'siglas'      				=>  "T",
	            	'color_hexadecimal' 		=> 	"#4705ce",
	        	],
	        	[
	            	'nombre'      				=>  "Particulares",
	            	'siglas'      				=>  "P",
	            	'color_hexadecimal' 		=> 	"#a5a5b8",
	        	],
        	]	
        );
    }
}
