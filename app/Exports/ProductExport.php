<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport extends StringValueBinder implements FromArray, WithHeadings, WithCustomCsvSettings, WithStyles, WithCustomValueBinder
{
    use Exportable;
    private $exportData;
    private $headings;

    public function __construct($exportData, $headings){
        $this->exportData = $exportData;
        $this->headings = $headings;
    }

    public function headings(): array
    {
        return $this->headings;
    }

//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()
//    {
//        return collect($this->exportData);
//    }

    public function array():array{
        return $this->exportData;
    }

    public function getCsvSettings():array{
        return [
            'delimiter' => ','
        ];
    }

    public function styles(Worksheet $sheet):array{
        $lastColumn = Coordinate::stringFromColumnIndex(count($this->headings()));
        return [
            1               => ['font' => ['bold' => true]],
            "A:$lastColumn" => ['numberFormat' => ['formatCode' => NumberFormat::FORMAT_TEXT]],
        ];
    }
}
