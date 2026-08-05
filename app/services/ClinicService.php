<?php

namespace App\services;

use App\Models\Clinics;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ClinicService
{
    use uploadImageTrait;

    public function create_Clinic(Request $request)
    {

        $clinic = new Clinics();
        $clinic->name = $request->name;
        $clinic->phone = $request->phone;
        $clinic->address = $request->address;
        $clinic->payment_date = $request->payment_date;
        $clinic->max_doctors = $request->max_doctors;
        $clinic->save();
        $this->uploadImge(
            $request,
            'photo',
            'Clinics',
            'upload_image',
            $clinic->id,
            'App\Models\Clinics'
        );

        $clinic->load('Images');
        return $clinic;
    }

    public function Update_clinic(Request $request, string $id)
    {

        $clinic = Clinics::findOrFail($id);
        $clinic->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_date' => $request->payment_date,
            'max_doctors' => $request->max_doctors,
        ]);
        if ($request->has('photo')) {

            if ($clinic->image) {
                $old_img = $clinic->image->filename;
                $this->Delete_attachment('upload_image', 'clinic/' . $old_img, $request->id);
            }

            $this->uploadImge($request, 'photo', 'clinic', 'upload_image', $request->id, 'App\Models\Clinics');
        }
        return $clinic;
    }

    public function search_by_name(Request $request)
    {
        $clinic = Clinics::with('Images')->where('name', 'LIKE', '%' . $request->name . '%')->get();

        return $clinic;
    }

    public function delete_clinic(string $id)
    {
        $clinic =  Clinics::findOrFail($id);
        if ($clinic->image) {
            $this->Delete_attachment(
                'upload_image',
                'clinic/' . $clinic->image->filename,
                $clinic->id
            );
        }
        $clinic->delete();
        return $clinic;
    }

    public function details($id)
    {
        $clinic = Clinics::findOrFail($id);
        return $clinic;
    }
}
