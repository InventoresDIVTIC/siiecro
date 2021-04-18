<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Response;

class ContactoController extends Controller
{
	public function index(){
    	return view('landing.contacto.index');
    }

    public function contacto(Request $request){
    	if($request->ajax()){
    		return Response::json(["mensaje" => "todo bien"], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
