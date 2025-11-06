<?php

namespace App\Exports;

use App\Models\Contacts;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConsultationsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * Fetch all contacts.
     */
    public function collection()
    {
        return Contacts::all();
    }

    /**
     * Map the data for each row.
     */
    public function map($consultations): array
    {
        return [
            $consultations->id,
            $consultations->name,
            $consultations->email,
            $consultations->contact_num,
            $consultations->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Define column headings.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Contact Number',
            'Submitted At',
        ];
    }

    /**
     * Apply styles to the sheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Style the header row
        $sheet->getStyle('A1:F1')->applyFromArray([
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
