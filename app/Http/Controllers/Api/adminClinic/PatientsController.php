<?php

namespace App\Http\Controllers\Api\adminClinic;

use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Controller;
use App\Models\Patients;
use App\services\AdminClinicServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientsController extends Controller
{
    public function __construct(protected AdminClinicServices $adminClinicServices)
    {
          $this->adminClinicServices = $adminClinicServices;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $patients = $this->adminClinicServices->create($request);
        if ($patients) {
            return response()->json([
                'status' => true,
                'message' => 'patients Add successfully.',
                'data' => $patients,
            ], 201);

    }
}
    
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patients = Patients::findOrfail($id);
         $patients->update([
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
        if ($patients) {
            return response()->json([
                'status' => true,
                'message' => 'patients updated successfully.',
                'data' => $patients,
            ], 201);

    }
}
    


    public function destroy(string $id)
{
    
    $patient = Patients::findOrFail($id); 

    $patient->delete();

    return response()->json([
        'status'  => true,
        'message' => 'Patient deleted successfully.',
    ], 200);
}
}

