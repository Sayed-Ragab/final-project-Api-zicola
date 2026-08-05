<?php

namespace App\Http\Controllers\Api\adminClinic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
          $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            //'clinic_id' => 'required|exists:clinics,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:Active,InAcive',
        ]);
        $data['clinic_id'] = Auth::user()->clinic_id;
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
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json([
            'status'=>true,
            'message'=>'Appointment is Deleted Successfully',
            'data'=>$appointment
        ]);
    }
}
