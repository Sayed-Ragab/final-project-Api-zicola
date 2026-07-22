<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Doctor extends Authenticatable
{
    protected $table = 'doctors';

    protected $guarded = [];


     public function doctorappointments()
    {
        return $this->belongsToMany(appointment_doctor::class,'appointment_doctor');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
