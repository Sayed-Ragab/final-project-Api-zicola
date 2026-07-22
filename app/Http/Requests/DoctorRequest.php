<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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

        'email' => 'required|email|unique:doctors,email',

        'phone' => 'required|string|unique:doctors,phone',

        'password' => 'required|min:8',

        'national_id' => 'required|digits:14|unique:doctors,national_id',

        'medical_license' => 'required|unique:doctors,medical_license',

        'specialization' => 'required|string|max:255',

        'gender' => 'required|in:male,female',

        'date_of_birth' => 'required|date',

        'blood_type' => 'required|string|max:5',

        'address' => 'required|string',

        'status' => 'required|in:active,suspended',
    ];
    }
}
