<?php

namespace App\services;

use App\Models\Doctor;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class DoctorServices
{
    use uploadImageTrait;


    public function CreateDoctors(Request $request)
    {
        $doctors = Doctor::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'national_id' => $request->national_id,
            'medical_license' => $request->medical_license,
            'specialization' => $request->specialization,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'blood_type' => $request->blood_type,
            'address' => $request->address,
            'status' => $request->status,
        ]);
        $this->uploadImge(
            $request,
            'photo',
            'doctors',
            'upload_image',
            $doctors->id,
            'App\Models\Doctor'
        );

        return $doctors;
    }
    public function Update(Request $request)
    {
        $doctors = Doctor::findOrfail($request->id);
        $doctors->name = $request->name;
        $doctors->email = $request->email;
        $doctors->national_id = $request->national_id;
        $doctors->medical_license = $request->medical_license;
        $doctors->specialization = $request->specialization;
        $doctors->gender = $request->gender;
        $doctors->date_of_birth = $request->date_of_birth;
        $doctors->blood_type = $request->blood_type;
        $doctors->address = $request->address;

        if ($request->filled('password')) {
            $doctors->password = Hash::make($request->password);
        }
        $doctors->save();

        if ($request->has('photo')) {

            if ($doctors->image) {
                $old_img = $doctors->image->filename;
                $this->Delete_attachment('upload_image', 'doctors/' . $old_img, $request->id);
            }

            $this->uploadImge($request, 'photo', 'doctors', 'upload_image', $request->id, 'App\Models\Doctor');
        }
        return $doctors;
    }

    public function search_byname(Request $request)
    {

        $doctors = Doctor::where('name', 'LIKE', '%' . $request->name . '%')->get();

        return $doctors;
    }
    public function search_by_phone(Request $request)
    {
        $doctors = Doctor::where('phone', $request->phone)->get();

        return $doctors;
    }

  public function Destroy(Request $request, string $id)
{
    $doctor = Doctor::findOrFail($id);

  if ($doctor->image) {

        $this->Delete_attachment(
            'upload_image',
            'doctors/' . $doctor->image->filename,
            $doctor->id
        );
    }

    $doctor->delete();

    return $doctor;
}
}
