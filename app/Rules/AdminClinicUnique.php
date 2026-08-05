<?php

namespace App\Rules;

use App\Models\Admin_clinic;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class AdminClinicUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Admin_clinic::where('admin_id',request('admin_id'))->where('clinic_id', request('clinic_id'))->exists()){

        $fail('هذا الأدمن مضاف إلى هذه العيادة من قبل.');
        }
        
    }
}
