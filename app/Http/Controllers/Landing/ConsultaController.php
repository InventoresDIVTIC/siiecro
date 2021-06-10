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
            $obras  =   Obras::consulta($request->input("busqueda"), $request->input("tipo"));
    		return view('landing.consulta.listado', ["obras" => $obras]);
    	}

    	return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function detalle(Request $request, $seo){
    	$obra 				=	Obras::where("seo", $seo)->first();

    	return view('landing.consulta.detalle', ["titulo" => $obra->nombre, "obra" => $obra]);
    }

    public function obtenerObrasRecomendadas(Request $request, $id_obra){
    	if ($request->ajax() || true) {
    		$base_conocimientos 	= 	Obras::selectRaw('
															id 		AS ID_OBRAS,
															tags 	AS TAGS_OBRAS
														')
												->whereNotNull("tags")
												->get();

			$base_conocimientos 	= 	json_encode($base_conocimientos, JSON_UNESCAPED_UNICODE);

			$process 				= 	new Process([public_path()."/scripts/landing/env/Scripts/python.exe", public_path()."/scripts/landing/recomienda.py", "$id_obra", "$base_conocimientos"]);
			$process->run();

			// executes after the command finishes
			if (!$process->isSuccessful()) {
			    // throw new ProcessFailedException($process);
			    $obras 				=	collect();
			} else{
				$obras_ids 			=	json_decode($process->getOutput());
				$obras 				=	Obras::whereIn("id", $obras_ids)->get();
			}

			return view('landing.consulta.recomendaciones', ["obras" => $obras]);
    	}

    	abort(404);
    }
}
