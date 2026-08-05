<?php

namespace App\Http\Requests;

use App\Rules\AdminClinicUnique;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class AdminClinicRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
        'clinic_id' => ['required', 'exists:clinics,id'],
       'admin_id' => [
        'required',
        'exists:admins,id',
        new AdminClinicUnique(),
    ],
        ];
    }
    #[Override]
    public function messages()
    {
        return [
        'clinic_id.required' => 'رقم العيادة مطلوب.',
        'clinic_id.exists'   => 'العيادة غير موجودة.',
        'clinic_id.unique'   => 'هذا الأدمن مضاف إلى هذه العيادة من قبل.',

        'admin_id.required'  => 'رقم الأدمن مطلوب.',
        'admin_id.exists'    => 'الأدمن غير موجود.',
    ];
    }
}
