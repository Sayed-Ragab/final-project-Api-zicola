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
    public function index()
    {
        
    }

    
    public function create()
    {
        //
    }

   
    public function store(DoctorRequest $request)
    {
        $doctors = $this->Doctorservice->CreateDoctors($request);
        if($doctors){
              return response()->json([
            'status' => true,
            'message' => 'Doctor  created  successfully.',
            'data' => $doctors, 
        ],201);
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
          if($doctors){
              return response()->json([
            'status' => true,
            'message' => 'Doctor  created  successfully.',
            'data' => $doctors, 
        ],201);
        }
    }

    public function search_by_name(Request $request){
    $doctor= $this->Doctorservice->search_byname($request);
          if($doctor){
             return response()->json([
        'status' => true,
        'count'  => $doctor->count(),
        'data'   => $doctor
    ], 200);
    }
    }
    public function search_by_phone(Request $request){
$doctors = $this->Doctorservice->search_by_phone($request);
          if($doctors){
              return response()->json([
            'status' => true,
            'message' => 'Doctor search by phone successfully.',
            'data' => $doctors, 
        ],201);
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
    }

