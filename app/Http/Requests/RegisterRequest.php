<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class RegisterRequest extends FormRequest
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
            'name'     => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
            'status'   => ['nullable', 'in:active,suspended,pending'],
        ];
    }

    #[Override]
    public function messages()
    {
        return [
          
            'name.required'     => 'الاسم مطلوب ولا يمكن تركه فارغاً.',
            'name.string'       => 'الاسم يجب أن يكون نصاً.',
            'name.max'          => 'الاسم طويل جداً (الحد الأقصى 255 حرفاً).',
            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'email.email'       => 'يرجى إدخال بريد إلكتروني بصيغة صحيحة.',
            'email.max'         => 'البريد الإلكتروني طويل جداً.',
            'email.unique'      => 'هذا البريد الإلكتروني مسجل بالفعل في النظام.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min'      => 'كلمة المرور يجب ألا تقل عن 8 أحرف أو أرقام.',            
        ];
    }
}
