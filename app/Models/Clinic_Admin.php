<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Clinic_Admin extends Authenticatable
{
    protected $guarded = [];


    public function Clinic(){
        return $this->hasMany(Clinics::class);
    }
}
