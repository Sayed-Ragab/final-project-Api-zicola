<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];



    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinics::class, 'clinic_id');
    }
    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'appointment_id');
    }

    public function scopeFilter(Builder $query): Builder
    {
        return $query->when(request('date'), function ($query, $date) {
            $query->whereDate('appointment_date', $date);
        })

            ->when(request()->filled('clinic_id'), function ($query) {
                $query->where('clinic_id', request('clinic_id'));
            })

            ->when(request('name') && request('type'), function ($query) {
                $relation = request('type');
                $name = request('name');

                $allowedRelations = [
                    'patient',
                    'doctor',
                    'clinic',
                ];

                if (! in_array($relation, $allowedRelations)) {
                    return;
                }

                $query->whereHas($relation, function ($q) use ($name) {
                    $q->where('name', 'like', "%{$name}%");
                });
            });
    }
}
