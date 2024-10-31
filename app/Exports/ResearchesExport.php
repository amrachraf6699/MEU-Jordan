<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ResearchesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $researches;

    public function __construct(Collection $researches)
    {
        $this->researches = $researches;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->researches; // Return the collection directly
    }

    // Map the data for each research record
    public function map($research): array
    {
        return [
            $research->title,
            $research->type,
            $research->status,
            $research->accreditation_status,
            $research->language,
            $research->date_of_publication->format('Y/m/d'),
            $research->sort,
            url($research->evidences),
            $research->indexing,
            $research->sources,
            $research->documentaion_period,
            $research->academic_year,
            $research->user->full_name ?? 'مستخدم محذوف',
            $research->user->employee_number ?? '-',
            $research->user->department->name ?? '-',
            $research->user->program->name ?? '-',
        ];
    }

    // Define the column headings for the exported file
    public function headings(): array
    {
        return [
            'العنوان',
            'النوع',
            'حالة النشر',
            'حالة الإعتماد',
            'اللغة',
            'تاريخ النشر',
            'الترتيب',
            'الأدلة',
            'الفهرسة',
            'المصادر',
            'فترة التوثيق',
            'السنة الأكاديمية',
            'اسم المستخدم',
            'الرقم الوظيفي',
            'قسم المستخدم',
            'برنامج المستخدم',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        // Set the worksheet to Right to Left
        $sheet->setRightToLeft(true);

        // Header styles
        $sheet->getStyle('A1:P1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
        ]);

        // Get the total number of rows with data
        $totalRows = $this->researches->count() + 1; // +1 for header row

        // Set alignment and borders for all data rows
        $sheet->getStyle('A1:P' . $totalRows)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
        ]);

        return $sheet;
    }

}
