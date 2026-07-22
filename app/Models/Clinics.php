<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinics extends Model
{
    
     public $guarded = [];

     public function clinic_admins(){

       return $this->hasMany(Clinic_Admin::class);
     }
}
