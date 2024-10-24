<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|alpha_dash|unique:users,username|max:255',
            'employee_number' => 'required|numeric|unique:users,employee_number',
            'role' => 'required|string|in:user,admin,committee_member',
            'department_id' => 'nullable|exists:departments,id',
            'program_id' => 'nullable|exists:programs,id',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.string' => 'الاسم الكامل يجب أن يكون نصًا.',
            'full_name.max' => 'الاسم الكامل يجب ألا يتجاوز 255 حرفًا.',

            'employee_number.numeric' => 'رقم الموظف يجب أن يكون رقمًا.',
            'employee_number.required' => 'رقم الموظف مطلوب.',
            'employee_number.unique' => 'رقم الموظف مستخدم بالفعل.',

            'username.required' => 'اسم المستخدم مطلوب.',
            'username.string' => 'اسم المستخدم يجب أن يكون نصًا.',
            'username.alpha_dash' => 'اسم المستخدم يجب أن يحتوي على أحرف، أرقام، شرطات، أو شرطات سفلية فقط.',
            'username.unique' => 'اسم المستخدم مستخدم بالفعل.',
            'username.max' => 'اسم المستخدم يجب ألا يتجاوز 255 حرفًا.',

            'role.in' => 'الرتبة المحددة غير صحيحة.',
            'role.required' => 'الرتبة مطلوبة.',

            'department_id.exists' => 'القسم المختار غير موجود.',
            'program_id.exists' => 'البرنامج المختار غير موجود.',
        ];
    }
}
