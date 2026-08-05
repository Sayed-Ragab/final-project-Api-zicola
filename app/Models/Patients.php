<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patients extends Authenticatable
{
  public $guarded = [];

  public function appointments()
{
    return $this->hasMany(Appointment::class);
}

public function Images(){
     return $this->morphOne(Image::class, 'imageable');
}



}
