<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;


use App\Obras;

class ObrasExport extends StringValueBinder implements FromCollection, WithHeadings, WithTitle, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $mostrarIds;

    function __construct($mostrarIds){
        $this->mostrarIds   =    $mostrarIds;
    }

    public function collection(){
        return Obras::whereNotNull('fecha_aprobacion')->get();
    }

    public function headings(): array{
        if ($this->mostrarIds) {
            return [
                'id',
                'nombre',
                'ano',
                'estatus_ano',
                'epoca_id',
                'estatus_epoca',
                'temporalidad_id',
                'autor',
                'cultura',
                'alto',
                'ancho',
                'profundidad',
                'diametro',
                'caracteristicas_descriptivas',
                'tipo_bien_cultural_id',
                'tipo_objeto_id',
                'lugar_procedencia_original',
                'lugar_procedencia_actual',
                'numero_inventario',
                'fecha_ingreso',
                'forma_ingreso',
                'area_id',
                'fecha_salida',
                'responsables_ecro',
                'proyecto_id',
                'temporadas_trabajo',
                'modalidad',
                'consulta_externa',
            ];
        } else{
            return [
                'No Registro',
                'Titulo',
                'Año',
                'Estatus año',
                'Época',
                'Estatus época',
                'Temporalidad',
                'Autor',
                'Cultura',
                'Alto',
                'Ancho',
                'Profundidad',
                'Diametro',
                'Caractersticas descriptivas',
                'Tipo de bien cultural',
                'Tipo de objeto',
                'Lugar de procedencia original',
                'Lugar de procedencia actual',
                'Número de inventario ó códigos',
                'Fecha de ingreso',
                'Fomra de ingreso',
                'Área',
                'Fecha de salida',
                'Persona que entregó',
                'Responsables ECRO',
                'Proyecto',
                'Temporadas de trabajo',
                'Modalidad',
                'Disponible para consulta externa'
            ];
        }
    }

    public function title(): string{
        return "Obras Sii-Ecro";
    }

    public function map($registro): array{
        if ($this->mostrarIds) {
            $responsablesEcro       =   $registro->responsables_asignados->pluck('id')->implode(",");
            $temporadasTrabajo      =   $registro->temporadas_trabajo_asignadas->pluck('año')->implode(", ");

            return [
                $registro->id,
                $registro->nombre,
                $registro->año ? $registro->año->format("Y") : "",
                $registro->estatus_año,
                $registro->epoca_id,
                $registro->estatus_epoca,
                $registro->temporalidad_id,
                $registro->autor,
                $registro->cultura,
                $registro->alto,
                $registro->ancho,
                $registro->profundidad,
                $registro->diametro,
                $registro->caracteristicas_descriptivas,
                $registro->tipo_bien_cultural_id,
                $registro->tipo_objeto_id,
                $registro->lugar_procedencia_original,
                $registro->lugar_procedencia_actual,
                $registro->numero_inventario,
                $registro->fecha_ingreso ? ExcelDate::dateTimeToExcel($registro->fecha_ingreso) : NULL,
                $registro->forma_ingreso,
                $registro->area_id,
                $registro->fecha_salida ? ExcelDate::dateTimeToExcel($registro->fecha_salida) : NULL,
                $responsablesEcro,
                $registro->proyecto_id,
                $temporadasTrabajo,
                $registro->modalidad,
                $registro->disponible_consulta == 0 ? "0" : "1",
            ];
        } else{
            $responsablesEcro       =   $registro->responsables_asignados->pluck('name')->implode(", ");
            $temporadasTrabajo      =   $registro->temporadas_trabajo_asignadas->pluck('año')->implode(", ");

            return [
                $registro->folio,
                $registro->nombre,
                $registro->año ? $registro->año->format("Y") : "",
                $registro->estatus_año,
                ($registro->epoca               ?   $registro->epoca->nombre                :   "N/A"),
                $registro->estatus_epoca,
                ($registro->temporalidad        ?   $registro->temporalidad->nombre         :   "N/A"),
                $registro->autor,
                $registro->cultura,
                $registro->alto,
                $registro->ancho,
                $registro->profundidad,
                $registro->diametro,
                $registro->caracteristicas_descriptivas,
                ($registro->tipo_bien_cultural  ?   $registro->tipo_bien_cultural->nombre   :   "N/A"),
                ($registro->tipo_objeto         ?   $registro->tipo_objeto->nombre          :   "N/A"),
                $registro->lugar_procedencia_original,
                $registro->lugar_procedencia_actual,
                $registro->numero_inventario,
                $registro->fecha_ingreso,
                $registro->forma_ingreso,
                ($registro->area                ?   $registro->area->nombre                 :   "N/A"),
                $registro->fecha_salida,
                $registro->persona_aprobo,
                $responsablesEcro,
                ($registro->proyecto            ?   $registro->proyecto->nombre             :   "N/A"),
                $temporadasTrabajo,
                $registro->modalidad,
                $registro->disponible_consulta ? "Si" : "No"
            ];
        }
        
    }

    public function styles(Worksheet $sheet){
        if ($this->mostrarIds) {
            $columnas   =   ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'AA', 'AB'];
        } else{
            $columnas   =   ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', 'AA', 'AB', 'AC'];

            // Filtros
            $sheet->setAutoFilter('A1:'.$columnas[count($columnas) - 1].'1');
        }

        // Estilos del header
        $sheet->getStyle('A1:'.$columnas[count($columnas) - 1].'1')->getFont()->setBold(true);
        $sheet->getStyle('A1:'.$columnas[count($columnas) - 1].'1')->getFill()->setFillType('solid')->getStartColor()->setARGB('CCCCCC');

        // Bordes negros del header
        foreach ($columnas as $col) {
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            $sheet->getStyle('A1:'.$col.'1')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }

        // Para que la primer columna quede estatica
        $sheet->freezePane('A2');
    }

    public function columnFormats(): array
    {
        if ($this->mostrarIds) {
            return [
                'C' => NumberFormat::FORMAT_NUMBER, // Año, solo numero
                'T' => 'yyyy-mm-dd hh:mm:ss', // Fecha de ingreso, formato de fecha aaaa-mm-dd hh:mm:ss
                'W' => 'yyyy-mm-dd hh:mm:ss', // Fecha de salida, formato de fecha aaaa-mm-dd hh:mm:ss
            ];
        }
    }
}
