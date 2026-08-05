<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequests extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
             return [
            'name' => 'required|string',
            'email' => 'required|email|unique:patients,email',
            'password' => 'required|min:8',
            'Date_Birth' => 'required|date',
            'Phone' => 'required|string|unique:patients,Phone',
            'patient_id' => 'required|digits:14|unique:patients,patient_id',
            'last_visit' => 'nullable|date',
            'status' => 'required',
            'Gender' => 'required',
            'Blood_Group' => 'required',
            'Address' => 'required|string',
        ];
        
    }

     public function messages(): array
    {
        return [
            'name.required' => 'من فضلك أدخل اسم المريض',
            'email.required' => 'من فضلك أدخل البريد الإلكتروني',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني موجود بالفعل',

            'password.required' => 'من فضلك أدخل كلمة المرور',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',

            'Phone.required' => 'من فضلك أدخل رقم الهاتف',
            'Phone.unique' => 'رقم الهاتف موجود بالفعل',

            'patient_id.required' => 'من فضلك أدخل رقم المريض',
            'patient_id.unique' => 'رقم المريض موجود بالفعل',

            'Date_Birth.required' => 'من فضلك أدخل تاريخ الميلاد',
            'Date_Birth.date' => 'تاريخ الميلاد غير صحيح',
        ];
    }
}
