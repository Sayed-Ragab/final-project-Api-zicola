<?php

namespace App\services;

use App\Models\Patients;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientServices
{
    use uploadImageTrait;

    public function createPatient(Request $request)
    {

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
        $this->uploadImge(
            $request,
            'photo',
            'Admin',
            'upload_image',
            $patients->id,
            'App\Models\Patients'
        );
        return $patients;
    }

    public function Updatepatient(Request $request)
    {

        $patients = Patients::findOrfail($request->id);

        $patients->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'Date_Birth' => $request->Date_Birth,
            'Phone' => $request->Phone,
            'patient_id' => $request->patient_id,
            'last_visit' => $request->last_visit,
            'status' => $request->status,
            'Gender' => $request->Gender,
            'Blood_Group' => $request->Blood_Group,
            'Address' => $request->Address
        ]);
        if ($request->filled('password')) {
            $patients->password = Hash::make($request->password);
        }
        if ($request->has('photo')) {

            if ($patients->image) {
                $old_img = $patients->image->filename;
                $this->Delete_attachment('upload_image', 'patients/' . $old_img, $request->id);
            }

            $this->uploadImge($request, 'photo', 'patients', 'upload_image', $request->id, 'App\Models\Patients');
        }

        return $patients;
    }

    public function GetPatients(Request $request)
    {

        $query = Patients::with('Images');

if ($request->filled('name')) {
    $query->where('name', 'like', "%{$request->name}%");
}

if ($request->filled('phone')) {
    $query->orWhere('Phone', 'like', "%{$request->phone}%");
}

$patients = $query->get();

        return $patients;
    }

    
    public function destroy(Request $request)
    {

        $patient = Patients::findOrFail($request->id);

        if ($patient->image) {

            $this->Delete_attachment(
                'upload_image',
                'patients/' . $patient->image->filename,
                $patient->id
            );
        }
        $patient->delete();
        return $patient;
    }
    public function changeStatus(string $id){
     $patiens = Patients::find($id);
    $patiens->status = ($patiens->status == "active") ? 'active' : 'inactive';
    return $patiens;
}

public function details(string $id){
      
    $details = Patients::with('Images')->findOrFail($id);
    return $details;

}
}
