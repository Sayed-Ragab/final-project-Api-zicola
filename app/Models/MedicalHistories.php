<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalHistories extends Model
{
    public $guarded = [];

    public function patients(){

        return $this->BelongsTo(Patients::class,'patients_id');
    }
}
