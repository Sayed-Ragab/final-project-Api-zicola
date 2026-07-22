<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Doctors extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = Doctor::create([
            'name'            => 'Dr. Ahmed Ali',
            'email'           => 'doctor@example.com',
            'phone'           => '01012345678',
            'password'        => bcrypt('12345678'),
            'national_id'     => '29501011234567',
            'medical_license' => 'LIC-99999',
            'specialization'  => 'Cardiology',
            'gender'          => 'male',
            'date_of_birth'   => '1985-05-15',
            'blood_type'      => 'A+',
            'address'         => 'Cairo, Egypt',
            'status'          => 'active',
        ]);
    }
}
