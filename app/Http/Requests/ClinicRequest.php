<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClinicRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'max_doctors' => 'required|integer',
            'payment_date' => 'nullable|date',
        ];
    }
    public function messages(): array
    {
       return [
        'name.required'        => 'اسم العيادة مطلوب ولا يمكن تركه فارغاً.',
        'name.unique'          => 'هذه العيادة مسجلة بالفعل في النظام.', 
        'phone.unique'         => 'رقم الهاتف هذا مسجل لعيادة أخرى بالفعل.', 
        'max_doctors.required' => 'حدد الحد الأقصى لعدد الأطباء.',
        'max_doctors.integer'  => 'عدد الأطباء يجب أن يكون رقماً صحيحاً.',
        'max_doctors.min'      => 'يجب أن يكون الحد الأقصى للأطباء طبيب واحد على الأقل.',
        'payment_date.date'    => 'تاريخ الدفع يجب أن يكون تاريخاً صحيحاً.',
    ];
    
    }
}
