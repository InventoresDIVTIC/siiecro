<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BD;

use App\Configuraciones;

class ConfiguracionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('VerificarPermiso:captura_de_catalogos_avanzada');
    }
    
    public function index(){
    	$titulo 		        = 	"Configuraciones";
    	
        $configuracion          =   Configuraciones::first();

        if (is_null($configuracion)) {
            $configuracion      =   new Configuraciones;
            $configuracion->save();
        }

    	return view("dashboard.configuraciones.index", ["titulo" => $titulo, "configuracion" => $configuracion]);
    }

    public function update(Request $request, $id){
        if($request->ajax()){
            $data   		= 	$request->all();
            $response 		= 	BD::actualiza($id, "Configuraciones", $data);
            return $response;
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
