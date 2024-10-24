<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UsersExport implements FromCollection, WithHeadings, WithStyles, WithEvents, ShouldAutoSize
{
    public function collection()
    {
        return User::with(['department', 'program', 'researches'])
            ->latest()
            ->get()
            ->map(function ($user) {
                return [
                    'full_name' => $user->full_name,
                    'username' => $user->username,
                    'employee_number' => $user->employee_number,
                    'role' => $this->getRoleLabelInArabic($user->role),
                    'department' => $user->department->name ?? 'غير محدد',
                    'program' => $user->program->name ?? 'غير محدد',
                    'researches_count' => $user->researches->count() > 0 ? $user->researches->count() : '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'الاسم الكامل',
            'اسم المستخدم',
            'الرقم الوظيفي',
            'الدور',
            'القسم',
            'البرنامج',
            'عدد النتاجات البحثية',
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->setRightToLeft(true);


        $sheet->getStyle('A1:G1')->applyFromArray([
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

        $sheet->getStyle('A1:G100')->applyFromArray([
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

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getColumnDimension('G')->setWidth(17);

                $highestRow = $sheet->getHighestRow();
                for ($row = 2; $row <= $highestRow; $row++) {
                    foreach (['E', 'F'] as $column) {
                        $cellValue = $sheet->getCell($column . $row)->getValue();
                        if ($cellValue === 'غير محدد') {
                            $sheet->getStyle($column . $row)->applyFromArray([
                                'fill' => [
                                    'fillType' => Fill::FILL_SOLID,
                                    'startColor' => ['argb' => 'FFFF0000'],
                                ],
                                'font' => [
                                    'color' => ['argb' => Color::COLOR_WHITE],
                                ],
                            ]);
                        }
                    }
                }
            },
        ];
    }

    private function getRoleLabelInArabic($role)
    {
        switch ($role) {
            case 'admin':
                return 'مشرف نظام';
            case 'committee_member':
                return 'عضو لجنة';
            case 'user':
                return 'مستخدم';
            default:
                return 'غير معروف';
        }
    }
}
