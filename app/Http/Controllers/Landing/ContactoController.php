<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use Response;

class ContactoController extends Controller
{
	public function index(){
    	return view('landing.contacto.index');
    }

    public function contacto(Request $request){
    	if($request->ajax()){
    		$nombre 		=	$request->input("nombre");
    		$correo 		=	$request->input("correo");
    		$telefono 		=	$request->input("telefono");
    		$mensaje 		=	$request->input("mensaje");

    		try {
    			Mail::send('mail.contacto', ["nombre" => $nombre, "correo" => $correo, "telefono" => $telefono, "mensaje" => $mensaje], function ($m) use($request) {
		            $m->from('siiecro@siiecro.com.mx', 'Sistema Siiecro');

		            $m->to(['d.academica@ecro.edu.mx', 'siiecro@ecro.edu.mx'])->subject($request->input("asunto"));
		        });
    		} catch (\Exception $e) {
                dd($e->getMessage());
        		return Response::json(["mensaje" => "Hubo un error al mandar el correo, contacte con los administradores"], 500);
    		}
			
    		return Response::json(["mensaje" => "todo bien"], 200);
        }

        return Response::json(["mensaje" => "Petición incorrecta"], 500);
    }
}
