<?php

namespace App\Clases;
use Illuminate\Http\Request;

use Session;
use Auth;
use Respuesta;
use Response;
use Image;
use File;
use Storage;

class Archivos
{
	public static function subirImagen($file, $nombre, $destino, $alto, $ancho = null){
        try {
            // Si no existe el directorio lo creamos
            if(!File::exists($destino)) {
                File::makeDirectory($destino, 0777, true, true);
            }

            if ( $file->getMimeType() != 'application/pdf' ) {
                $imagen     =  Image::make($file->path());

                // Resize
                $imagen->resize($alto, $ancho, function ($constraint) {
                    $constraint->aspectRatio();
                });
                
                $imagen->save($destino."/".$nombre);
            }elseif ( $file->getMimeType() == 'application/pdf' ) {
                $file->move($destino, $nombre);
            }

            return "";
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function eliminarArchivo($archivo){
        File::delete($archivo);
    }
}
