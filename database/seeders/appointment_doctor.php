<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class appointment_doctor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('appointment_doctors')->delete();
         $doctor = Doctor::first();
      $appointments = [
                ['doctor_id' => $doctor->id, 'name' => 'السبت', 'created_at' => now(), 'updated_at' => now()],
                ['doctor_id' => $doctor->id, 'name' => 'الأحد', 'created_at' => now(), 'updated_at' => now()],
                ['doctor_id' => $doctor->id, 'name' => 'الإثنين', 'created_at' => now(), 'updated_at' => now()],
                ['doctor_id' => $doctor->id, 'name' => 'الثلاثاء', 'created_at' => now(), 'updated_at' => now()],
                ['doctor_id' => $doctor->id, 'name' => 'الأربعاء', 'created_at' => now(), 'updated_at' => now()],
                ['doctor_id' => $doctor->id, 'name' => 'الخميس', 'created_at' => now(), 'updated_at' => now()],
                ['doctor_id' => $doctor->id, 'name' => 'الجمعة', 'created_at' => now(), 'updated_at' => now()],
            ];

DB::table('appointment_doctors')->insert($appointments);
    }
}
