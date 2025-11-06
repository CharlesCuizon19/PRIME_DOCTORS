<?php

namespace App\Exports;

use App\Models\Newsletter;
use App\Models\Newsletters;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NewslettersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     */
    public function collection()
    {
        return Newsletters::orderBy('created_at', 'desc')->get();
    }

    /**
     * Map the data for each row.
     */
    public function map($newsletter): array
    {
        return [
            $newsletter->id,
            $newsletter->email,
            $newsletter->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Define column headings.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Email',
            'Submitted At',
        ];
    }

    /**
     * Apply styles to the sheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Style the header row
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '4F81BD'], // blue background
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // Auto-wrap text for description column
        $sheet->getStyle('E')->getAlignment()->setWrapText(true);

        return [
            // Bold first row
            1 => ['font' => ['bold' => true]],
        ];
    }
}
