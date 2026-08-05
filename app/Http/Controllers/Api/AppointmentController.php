<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    public function index()
    {
         $appointments = Appointment::with([
                'patient:id,name',
                'doctor:id,name',
                'clinic:id,name',
            ])->filter()->latest('appointment_date')->paginate(10);

               return response()->json($appointments);
      
    }

    
    public function create()
    {
        //
    }

    
        public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required|exists:clinics,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:Active,InAcive',
        ]);

        $appointment = Appointment::create($data);

        return response()->json(
            $appointment->load([
                'patient:id,name',
                'doctor:id,name',
                'clinic:id,name',
                
            ]),
            201
        );
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findorFail($id);

        $appointment->delete();

        return response()->json([
    'status' => true,
    'message' => 'delete appointment successfully',
    'data' => $appointment,
], 200);;

    }
}
