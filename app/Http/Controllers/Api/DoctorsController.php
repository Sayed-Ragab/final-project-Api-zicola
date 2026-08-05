<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\services\DoctorServices;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function __construct(protected DoctorServices $Doctorservice)
    {
        $this->Doctorservice = $Doctorservice;
    }
    public function index() {}


    public function create()
    {
        //
    }


    public function store(DoctorRequest $request)
    {
        $doctors = $this->Doctorservice->CreateDoctors($request);
        if ($doctors) {
            return response()->json([
                'status' => true,
                'message' => 'Doctor  created  successfully.',
                'data' => $doctors,
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        $doctors = $this->Doctorservice->Update($request);
        if ($doctors) {
            return response()->json([
                'status' => true,
                'message' => 'Doctor  created  successfully.',
                'data' => $doctors,
            ], 201);
        }
    }

  
    public function GetDoctors(Request $request)
    {
        $doctors = $this->Doctorservice->GetDoctors($request);
        if ($doctors) {
            return response()->json([
                'status' => true,
                'message' => 'Doctor search by phone successfully.',
                'data' => $doctors,
            ], 201);
        }
    }
    public function destroy(Request $request, string $id)
    {
        $doctor = $this->Doctorservice->Destroy($request, $id);

        return response()->json([
            'status' => true,
            'message' => 'Doctor Deleted successfully.',
            'data' => $doctor,
        ], 200);
    }
    public function Details($id){
        
    $doctor = $this->Doctorservice->Details($id);

         return response()->json([
        'id'            => $doctor->id,
        'name'          => $doctor->name,
        'email'   => $doctor->email,
        'address'       => $doctor->address,
        'phone'         => $doctor->phone,
        'status'        => $doctor->status,
        'national_id'  =>$doctor->national_id,
        'specialization_id'=>$doctor->specialization ? $doctor->specialization->name : null,
          'gender'  => $doctor->gender,
          'date_of_birth' =>$doctor->date_of_birth,
          'blood_type'  => $doctor -> blood_type,   
       'image' => $doctor->image
    ? asset('upload_image/doctors/' . $doctor->image->filename) : null
   ]);
    }
}

