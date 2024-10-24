<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'program_id' => 'required|exists:programs,id',
        ];
    }

    /**
     * Get the validation error messages for the defined rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'department_id.required' => 'القسم مطلوب',
            'department_id.exists' => 'القسم المختار غير موجود',

            'program_id.required' => 'البرنامج مطلوب',
            'program_id.exists' => 'البرنامج المختار غير موجود',
        ];
    }
}
