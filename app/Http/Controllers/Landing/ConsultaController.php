<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use App\Obras;

class ConsultaController extends Controller
{
	public function index(){
    	return view('landing.consulta.index');
    }

    public function busqueda(Request $request){
    	if ($request->ajax()) {
            sleep(3);
    		return view('landing.consulta.listado');
    	}

    	return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function detalle(Request $request, $seo){
    	$obra 				=	Obras::first();
    	$obrasRecomendadas 	=	Obras::all()->take(3);

    	return view('landing.consulta.detalle', ["titulo" => $obra->nombre, "obra" => $obra, "obrasRecomendadas" => $obrasRecomendadas]);
    }

    public function obtenerObrasRecomendadas(Request $request, $obra_id){
        // Aqui va la implementacion de la caja negra de AI
        if ($obra_id <= 0) {
        	return Response::json(["mensaje" => "Petición incorrecta"], 500);
        }
		
		$id_obra 			= $obra_id;
		$base_conocimientos = Obras::selectRaw('
													obras.id AS ID_OBRAS,
													obras.tags AS TAGS_OBRAS
												')
									// ->limit(5)
									->get();

		$base_conocimientos = json_encode($base_conocimientos, JSON_UNESCAPED_UNICODE);

		// $process = new Process([public_path()."/scripts/landing/env/Scripts/python.exe", public_path()."/scripts/landing/recomienda.py", "$id_obra", "$base_conocimientos"]);
		$process = new Process(["python", public_path()."/scripts/landing/recomienda.py", "$id_obra", "$base_conocimientos"]);
		$process->run();

		// executes after the command finishes
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}

		// $respuesta = $process->getOutput();
		// Result (string): [2,3]
		// $respuesta = json_decode($respuesta);
		// Result (Array): (2,3)
		$respuesta = json_decode($process->getOutput());
		// Result (Array): (2,3)
		return $respuesta;
    }
}
