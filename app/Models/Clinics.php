<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Clinics extends Model
{

    public $guarded = [];

    public function adminClinic()
    {
        return $this->hasOne(Admin_clinic::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class,'clinic_id');
    }
    public function Images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'clinic_id');
    }
public function admins()
{
    return $this->hasMany(Admin_clinic::class, 'clinic_id');
}
}
