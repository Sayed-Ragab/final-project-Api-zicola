<?php

namespace App\Http\Controllers\Api\adminClinic;

use App\Http\Controllers\Controller;
use App\Models\MedicalHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalHistoryController extends Controller
{
    public function show(){

    }
    public function create(Request $request){

        MedicalHistories::create([
            'patient_id'       =>Auth::user()->id,
            'medical_history'=>$request->medical_history,
            'allergies'=>$request->allergies,
            'chronic_diseases'=>$request->chronic_diseases

        ]);
    }

}
