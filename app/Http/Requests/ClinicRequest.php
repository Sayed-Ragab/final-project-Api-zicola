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
            'max_doctors.required' => 'حدد الحد الأقصى لعدد الأطباء.',
            'max_doctors.integer'  => 'عدد الأطباء يجب أن يكون رقماً.',
        ];
    }
}
