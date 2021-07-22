<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Obras;

class ObrasExport implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $mostrarIds;

    function __construct($mostrarIds){
        $this->mostrarIds   =    $mostrarIds;
    }

    public function collection()
    {
        return Obras::whereNotNull('fecha_aprobacion')->get();
    }

    public function headings(): array
    {
        return [
            $this->mostrarIds     ?   'id'                        :   'No Registro',
            $this->mostrarIds     ?   'tipo_objeto_id'            :   'tipo_objeto',
            $this->mostrarIds     ?   'tipo_bien_cultural_id'     :   'tipo_bien_cultural',
            $this->mostrarIds     ?   'epoca_id'                  :   'epoca',
            $this->mostrarIds     ?   'temporalidad_id'           :   'temporalidad',
            $this->mostrarIds     ?   'area_id'                   :   'area',
            $this->mostrarIds     ?   'proyecto_id'               :   'proyecto',
            'nombre',
            'autor',
            'cultura',
            'lugar_procedencia_actual',
            'numero_inventario',
            'año',
            'estatus_año',
            'estatus_epoca',
            'alto',
            'diametro',
            'profundidad',
            'ancho',
            'fecha_ingreso',
            'fecha_salida',
            'modalidad',
            'caracteristicas_descriptivas',
            'lugar_procedencia_original',
            'forma_ingreso',
            'consulta_externa'
        ];
    }

    public function title(): string{
        return "Obras Sii-Ecro";
    }

    public function map($registro): array{
        return [
            $this->mostrarIds     ?   $registro->id                        :   $registro->folio,
            $this->mostrarIds     ?   $registro->tipo_objeto_id            :   ($registro->tipo_objeto         ?   $registro->tipo_objeto->nombre          :   "N/A"),
            $this->mostrarIds     ?   $registro->tipo_bien_cultural_id     :   ($registro->tipo_bien_cultural  ?   $registro->tipo_bien_cultural->nombre   :   "N/A"),
            $this->mostrarIds     ?   $registro->epoca_id                  :   ($registro->epoca               ?   $registro->epoca->nombre                :   "N/A"),
            $this->mostrarIds     ?   $registro->temporalidad_id           :   ($registro->temporalidad        ?   $registro->temporalidad->nombre         :   "N/A"),
            $this->mostrarIds     ?   $registro->area_id                   :   ($registro->area                ?   $registro->area->nombre                 :   "N/A"),
            $this->mostrarIds     ?   $registro->proyecto_id               :   ($registro->proyecto            ?   $registro->proyecto->nombre             :   "N/A"),
            $registro->nombre,
            $registro->autor,
            $registro->cultura,
            $registro->lugar_procedencia_actual,
            $registro->numero_inventario,
            $registro->año,
            $registro->estatus_año,
            $registro->estatus_epoca,
            $registro->alto,
            $registro->diametro,
            $registro->profundidad,
            $registro->ancho,
            $registro->fecha_ingreso,
            $registro->fecha_salida,
            $registro->modalidad,
            $registro->caracteristicas_descriptivas,
            $registro->lugar_procedencia_original,
            $registro->forma_ingreso,
            $registro->disponible_consulta
        ];
    }

    public function styles(Worksheet $sheet){
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);

        for ($i = 'A'; $i < 'Z'; $i++) { 
            $sheet->getStyle('A1:'.$i.'1')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$i.'1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$i.'1')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$i.'1')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }
    }
}
