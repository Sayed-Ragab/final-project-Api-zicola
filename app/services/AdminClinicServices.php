<?php

namespace App\services;

use App\Models\EmergencyContact;
use App\Models\MedicalHistories;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminClinicServices
{

    public function create(Request $request)
    {
        DB::beginTransaction();
        try{

        

        $patients = Patients::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Date_Birth' => $request->Date_Birth,
            'Phone' => $request->Phone,
            'patient_id' => $request->patient_id,
            'last_visit' => $request->last_visit,
            'status' => $request->status,
            'Gender' => $request->Gender,
            'Blood_Group' => $request->Blood_Group,
            'Address' => $request->Address
        ]);

        MedicalHistories::create([
             'patient_id' => $patients->id,
            'medical_history'   => $request->medical_history,
            'allergies'         => $request->allergies,
            'chronic_diseases'  => $request->chronic_diseases,
        ]);

        EmergencyContact::create([
             'patient_id' => $patients->id,
            'contact_name' => $request->contact_name,
            'relationship' => $request->relationship,
            'phone_number' => $request->phone_number,
        ]);

        DB::commit();

        }catch(\Exception $e){
              DB::rollBack();
                  return response()->json([
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile(),
    ], 500);
        }
         return $patients;
    }
   
}
