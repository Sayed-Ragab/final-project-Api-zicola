<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $guarded = [];

    public function patients(){

        return $this->BelongsTo(Patients::class,'patients_id');
    }
}
