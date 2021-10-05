<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use PDF;

class ProyectosTemporadasTrabajo extends Model
{
    protected $table = "proyectos__temporadas_trabajo";
    protected $fillable = [
    	'id',
        'proyecto_id',
        'año',
        'numero_temporada'
    ];

    public function proyecto() {
        return $this->hasOne('App\Proyectos', 'id', 'proyecto_id');
    }

    public function obras_asignadas() {
        return $this->hasManyThrough(
            'App\Obras',
            'App\ObrasTemporadasTrabajoAsignadas',
            'proyecto_temporada_trabajo_id', // Llave foranea de primer tabla con segunda tabla
            'id', // Llave foranea de segunda tabla con tercera tabla
            'id', // llave foranea de segunda tabla con primera tabla
            'obra_id' // llave foranea de tercera tabla con segunda tabla
        );
    }

    public function generarPdfEntrada(){
        $configuracion  =   Configuraciones::first();
        $pdf            =  PDF::loadView('pdf.temporada-trabajo-entrada', ["temporada" => $this, "configuracion" => $configuracion]);
        return $pdf;
    }

    public function generarPdfSalida(){
        $configuracion  =   Configuraciones::first();
        $pdf            =  PDF::loadView('pdf.temporada-trabajo-salida', ["temporada" => $this, "configuracion" => $configuracion]);
        return $pdf;
    }
}
