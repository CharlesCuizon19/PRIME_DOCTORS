<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AppointmentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Appointment::with('doctor.specializations')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function map($appointment): array
    {
        $specializations = $appointment->doctor?->specializations
            ->pluck('specialization_name')
            ->join(', ') ?? 'N/A';

        return [
            $appointment->id,
            $appointment->doctor->name ?? 'N/A',
            $specializations,
            $appointment->full_name,
            $appointment->phone_number,
            $appointment->appointment_date?->format('Y-m-d') ?? 'N/A',
            $appointment->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Doctor Name',
            'Specializations',
            'Patient Name',
            'Phone Number',
            'Appointment Date',
            'Created At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '2563EB'], // blue header
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        $sheet->getStyle('B:G')->getAlignment()->setWrapText(true);

        return [1 => ['font' => ['bold' => true]]];
    }
}
