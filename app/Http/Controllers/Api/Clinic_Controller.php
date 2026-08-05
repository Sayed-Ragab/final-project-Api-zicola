<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\services\ClinicService;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;

class Clinic_Controller extends Controller
{
    use uploadImageTrait;
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
            'message' => 'AdminClinic  created  successfully.',
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
            'message' => 'clinic  Update  successfully.',
            'data' => $clinic, 
        ],201);
        }
    }
 public function search_by_name(Request $request){
      $clinic = $this->clinic_service->search_by_name($request);
        if($clinic){
              return response()->json([
            'status' => true,
            'message' => 'clinic searched successfully.',
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
            'message' => 'Clinic Deleted successfully.',
            'data' => $clinic, 
        ],201);

    }
}
public function details(string $id){
      $clinic = $this->clinic_service->details($id);
    if (!$clinic) {
        return response()->json([
            'message' => 'العيادة غير موجودة'
        ], 404);
    }
    
      return response()->json([
        'id'            => $clinic->id,
        'name'          => $clinic->name,
        'description'   => $clinic->description,
        'address'       => $clinic->address,
        'phone'         => $clinic->phone,
        'status'        => $clinic->status,
       'image' => $clinic->Images->first()
    ? asset('upload_image/clinics/' . $clinic->Images->first()->filename)
    : null,
        'active_admins' => $clinic->admins()->where('status', 'active')->count(),
        'total_doctors' => $clinic->max_doctors,
        'todays_visits' => $clinic->appointments()->distinct('patient_id')->count('patient_id'),
    ]);
}
}

