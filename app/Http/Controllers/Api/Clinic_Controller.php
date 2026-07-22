<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\services\ClinicService;
use Illuminate\Http\Request;

class Clinic_Controller extends Controller
{
    public function __construct(protected ClinicService $clinic_service)
    {
        $this->clinic_service = $clinic_service;
    }
    
    public function index()
    {
        
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
    public function store(ClinicRequest $request)
    {
        $clinic = $this->clinic_service->create_Clinic($request);
        if($clinic){
              return response()->json([
            'status' => true,
            'message' => 'Doctor  created  successfully.',
            'data' => $clinic, 
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $clinic = $this->clinic_service->Update_clinic($request,$id);
        if($clinic){
              return response()->json([
            'status' => true,
            'message' => 'Doctor  Update  successfully.',
            'data' => $clinic, 
        ],201);
        }
    }
 public function search_by_name(Request $request){
      $clinic = $this->clinic_service->search_by_name($request);
        if($clinic){
              return response()->json([
            'status' => true,
            'message' => 'Doctor searched successfully.',
            'data' => $clinic, 
        ],201);
        }
 }
    
    public function destroy(string $id)
    {
         $clinic = $this->clinic_service->delete_clinic($id);

             if($clinic){
              return response()->json([
            'status' => true,
            'message' => 'Doctor Deleted successfully.',
            'data' => $clinic, 
        ],201);

    }
}
}