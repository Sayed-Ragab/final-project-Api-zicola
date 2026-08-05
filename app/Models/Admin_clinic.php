<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin_clinic extends Authenticatable
{
     use HasApiTokens, Notifiable;
    protected $guarded = [];

       public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinics::class);
    }
    public function Patients()
    {
        return $this->belongsTo(Patients::class);
    }

}
