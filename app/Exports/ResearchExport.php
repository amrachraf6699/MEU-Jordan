<?php

namespace App\Exports;

use App\Models\Research;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResearchExport implements FromCollection, WithHeadings, WithMapping
{
    protected $research;

    public function __construct(Research $research)
    {
        $this->research = $research;
    }

    // Map the data for each research record
    public function map($row): array
    {
        return [
            $this->research->title,
            $this->research->user->full_name,
            $this->research->status,
            $this->research->language,
            $this->research->date_of_publication->format('Y/m/d'),
            optional($this->research->user->department)->name ?? 'غير متوفر',
            optional($this->research->user->program)->name ?? 'غير متوفر',
        ];
    }

    // Define the column headings for the exported file
    public function headings(): array
    {
        return [
            'العنوان',
            'المستخدم',
            'الحالة',
            'اللغة',
            'تاريخ النشر',
            'القسم',
            'البرنامج',
        ];
    }

    // Return a collection containing only the current research record
    public function collection()
    {
        return collect([$this->research]);
    }
}
