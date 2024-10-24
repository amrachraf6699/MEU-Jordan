<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'employee_number' => 'required|string|max:255|unique:users,employee_number,' . $this->user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $this->user->id,
            'role' => 'required|string|in:admin,user,committee_member',
            'department_id' => 'required|exists:departments,id',
            'program_id' => 'required|exists:programs,id',
            'password' => 'nullable|string|min:8',

        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب.',
            'full_name.string' => 'يجب أن يكون الاسم الكامل نصًا.',
            'full_name.max' => 'يجب أن لا يتجاوز الاسم الكامل 255 حرفًا.',

            'employee_number.required' => 'رقم الموظف مطلوب.',
            'employee_number.string' => 'يجب أن يكون رقم الموظف نصًا.',
            'employee_number.max' => 'يجب أن لا يتجاوز رقم الموظف 255 حرفًا.',
            'employee_number.unique' => 'رقم الموظف مستخدم بالفعل.',

            'username.required' => 'اسم المستخدم مطلوب.',
            'username.string' => 'يجب أن يكون اسم المستخدم نصًا.',
            'username.max' => 'يجب أن لا يتجاوز اسم المستخدم 255 حرفًا.',
            'username.unique' => 'اسم المستخدم مستخدم بالفعل.',

            'role.required' => 'الرتبة مطلوبة.',
            'role.string' => 'يجب أن تكون الرتبة نصًا.',
            'role.in' => 'يجب أن تكون الرتبة واحدة من: مسؤول, مستخدم, عضو لجنة.', // Translated roles

            'department_id.required' => 'القسم مطلوب.',
            'department_id.exists' => 'القسم المحدد غير موجود.',

            'program_id.required' => 'البرنامج مطلوب.',
            'program_id.exists' => 'البرنامج المحدد غير موجود.',
        ];
    }

}
