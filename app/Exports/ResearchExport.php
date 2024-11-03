<?php

namespace App\Exports;

use App\Models\Research;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ResearchExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $research;

    public function __construct(Research $research)
    {
        $this->research = $research;
    }

    public function map($row): array
    {
        return [
            $this->research->title,
            $this->research->type,
            $this->research->status,
            $this->research->accreditation_status,
            $this->research->language,
            $this->research->date_of_publication->format('Y/m/d'),
            $this->research->sort,
            url($this->research->evidences),
            $this->research->indexing,
            $this->research->sources,
            $this->research->documentaion_period,
            $this->research->academic_year,
            $this->research->priority,
            $this->research->publication_link,
            $this->research->user->full_name ?? 'مستخدم محذوف',
            $this->research->user->employee_id ?? '-',
            $this->research->user->department->name ?? '-',
            $this->research->user->program->name ?? '-',
        ];
    }

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
            'الأولويات البحثية',
            'رابط المنشور البحثي',
            'اسم المستخدم',
            'الرقم الوظيفي',
            'قسم المستخدم',
            'برنامج المستخدم',
        ];
    }

    public function collection()
    {
        return collect([$this->research]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setRightToLeft(true);
        $sheet->getStyle('A1:O1')->applyFromArray([
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

        $totalRows = $this->research->count() + 1;

        $sheet->getStyle('A1:O' . $totalRows)->applyFromArray([
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
