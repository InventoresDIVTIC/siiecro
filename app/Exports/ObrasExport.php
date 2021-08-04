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
        if ($this->mostrarIds) {
            return [
                'id',
                'tipo_objeto_id',
                'tipo_bien_cultural_id',
                'epoca_id',
                'temporalidad_id',
                'area_id',
                'proyecto_id',
                'nombre',
                'autor',
                'cultura',
                'lugar_procedencia_actual',
                'numero_inventario',
                'ano',
                'estatus_ano',
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
                'consulta_externa',
                'responsables_ecro'
            ];
        } else{
            return [
                'No Registro',
                'tipo_objeto',
                'tipo_bien_cultural',
                'epoca',
                'temporalidad',
                'area',
                'proyecto',
                'temporadas_trabajo',
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
                'persona_entrego',
                'fecha_salida',
                'modalidad',
                'caracteristicas_descriptivas',
                'lugar_procedencia_original',
                'responsables_ecro',
                'forma_ingreso',
                'consulta_externa'
            ];
        }
        
    }

    public function title(): string{
        return "Obras Sii-Ecro";
    }

    public function map($registro): array{
        if ($this->mostrarIds) {
            $responsablesEcro       =   $registro->responsables_asignados->pluck('id')->implode(",");

            return [
                $registro->id,
                $registro->tipo_objeto_id,
                $registro->tipo_bien_cultural_id,
                $registro->epoca_id,
                $registro->temporalidad_id,
                $registro->area_id,
                $registro->proyecto_id,
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
                $registro->disponible_consulta,
                $responsablesEcro
            ];
        } else{
            $responsablesEcro       =   $registro->responsables_asignados->pluck('name')->implode(", ");
            $temporadasTrabajo      =   $registro->temporadas_trabajo_asignadas->pluck('año')->implode(", ");

            return [
                $registro->folio,
                ($registro->tipo_objeto         ?   $registro->tipo_objeto->nombre          :   "N/A"),
                ($registro->tipo_bien_cultural  ?   $registro->tipo_bien_cultural->nombre   :   "N/A"),
                ($registro->epoca               ?   $registro->epoca->nombre                :   "N/A"),
                ($registro->temporalidad        ?   $registro->temporalidad->nombre         :   "N/A"),
                ($registro->area                ?   $registro->area->nombre                 :   "N/A"),
                ($registro->proyecto            ?   $registro->proyecto->nombre             :   "N/A"),
                $temporadasTrabajo,
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
                $registro->persona_aprobo,
                $registro->fecha_salida,
                $registro->modalidad,
                $registro->caracteristicas_descriptivas,
                $registro->lugar_procedencia_original,
                $responsablesEcro,
                $registro->forma_ingreso,
                $registro->disponible_consulta
            ];
        }
        
    }

    public function styles(Worksheet $sheet){
        if ($this->mostrarIds) {
            $columnas   =   ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'AA'];
        } else{
            $columnas   =   ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'AA', 'AB', 'AC'];
        }

        $sheet->getStyle('A1:'.$columnas[count($columnas) - 1].'1')->getFont()->setBold(true);

        foreach ($columnas as $col) {
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }
    }
}
