<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Obras;

class ConsultaController extends Controller
{
	public function index(){
    	return view('landing.consulta.index');
    }

    public function busqueda(Request $request){
    	if ($request->ajax()) {
    		return view('landing.consulta.listado');
    	}

    	return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }

    public function detalle(Request $request, $seo){
    	$obra 	=	Obras::first();

    	return view('landing.consulta.detalle', ["titulo" => $obra->nombre, "obra" => $obra]);
    }

    public function obtenerObrasRecomendadas(Request $request, $obra_id){
        // Aqui va la implementacion de la caja negra de AI
    }
}
