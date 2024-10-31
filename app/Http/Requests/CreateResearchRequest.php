<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateResearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->full_name && auth()->user()->employee_number && auth()->user()->role && auth()->user()->department_id && auth()->user()->program_id && auth()->user()->username;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255|exists:types,value',
            'status' => 'required|string|max:255|exists:statuses,value',
            'language' => 'required|string|max:255|exists:languages,value',
            'date_of_publication' => 'required|date|beforeor_equal:today',
            'sort' => 'required|string|max:255',
            'evidences' => ($this->isMethod('POST') ? 'required' : 'nullable') . '|file|mimes:pdf,doc,docx|max:2048',
            'indexing' => 'array',
            'indexing.*' => 'required|string|max:255|exists:indexings,value',
            'sources' => 'required|string|max:255',
            'documentaion_period' => 'required|exists:documentaion_periods,value',
            'academic_year' => 'required|string|max:255|exists:academic_years,value',
        ];
    }


    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'يجب إدخال عنوان البحث.',
            'title.string' => 'يجب أن يكون عنوان البحث نصًا.',
            'title.max' => 'يجب ألا يتجاوز عنوان البحث 255 حرفًا.',
            'type.required' => 'يجب إدخال نوع البحث.',
            'type.string' => 'يجب أن يكون نوع البحث نصًا.',
            'type.max' => 'يجب ألا يتجاوز نوع البحث 255 حرفًا.',
            'language.required' => 'يجب إدخال اللغة.',
            'language.string' => 'يجب أن تكون اللغة نصًا.',
            'language.max' => 'يجب ألا تتجاوز اللغة 255 حرفًا.',
            'date_of_publication.required' => 'يجب إدخال تاريخ النشر.',
            'date_of_publication.date' => 'يجب أن يكون تاريخ النشر تاريخًا صحيحًا.',
            'date_of_publication.before' => 'يجب أن يكون تاريخ النشر قبل اليوم.',
            'sort.required' => 'يجب إدخال التصنيف.',
            'sort.string' => 'يجب أن يكون التصنيف نصًا.',
            'sort.max' => 'يجب ألا يتجاوز التصنيف 255 حرفًا.',
            'evidences.required' => 'يجب إدخال وثيقة.',
            'evidences.file' => 'يجب أن تكون الشواهد ملفًا.',
            'evidences.mimes' => 'يجب أن تكون الشواهد من نوع: pdf, doc, docx.',
            'evidences.max' => 'يجب ألا يتجاوز حجم الشواهد 2 ميجابايت.',
            'indexing.required' => 'يجب إدخال الفهرسة.',
            'indexing.string' => 'يجب أن تكون الفهرسة نصًا.',
            'indexing.max' => 'يجب ألا تتجاوز الفهرسة 255 حرفًا.',
            'sources.required' => 'يجب إدخال المصادر.',
            'sources.string' => 'يجب أن تكون المصادر نصًا.',
            'sources.max' => 'يجب ألا تتجاوز المصادر 255 حرفًا.',
            'documentaion_period.required' => 'يجب إدخال فترة توثيق',
            'documentaion_period.exists' => 'يجب إدخال فترة توثيق صالحة',
            'academic_year.required' => 'يجب إدخال السنة الأكاديمية.',
            'academic_year.string' => 'يجب أن تكون السنة الأكاديمية نصًا.',
            'academic_year.max' => 'يجب ألا تتجاوز السنة الأكاديمية 255 حرفًا.',
            'status.required' => 'يجب إدخال الحالة.',
            'status.string' => 'يجب أن تكون الحالة نصًا.',
            'status.max' => 'يجب ألا تتجاوز الحالة 255 حرفًا.',
            'status.exists' => 'يجب إدخال حالة صالحة',
        ];
    }
}
