<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequests;
use App\services\PatientServices;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function __construct(protected PatientServices $patinetservices)
    {
        $this->patinetservices = $patinetservices;
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
    public function store(PatientRequests $request)
    {
        $patients = $this->patinetservices->createPatient($request);

        return response()->json([
            'status' => true,
            'message' => 'patiens created successfully.',
            'data' => $patients,
        ], 200);
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

    public function GetPatients(Request $request)
    {

        $patients = $this->patinetservices->GetPatients($request);

        if ($patients->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'عذراً، لم يتم العثور على مريض بهذا الاسم أو البيانات المدخلة.',
                'data'    => []
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'patient serched successfully.',
            'data' => $patients,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $patients = $this->patinetservices->Updatepatient($request);

        return response()->json([
            'status' => true,
            'message' => 'patiens updated successfully.',
            'data' => $patients,
        ], 200);
    }

   public function details(string $id){
      
    $patients = $this->patinetservices->details($id);
    return response()->json([
        'id'            => $patients->id,
        'name'          => $patients->name,
        'email'   => $patients->email,
        'Address'       => $patients->Address,
        'Phone'         => $patients->Phone,
        'status'        => $patients->status,
        'national_id'  =>$patients->national_id,
          'Gender'  => $patients->Gender,
          'Date_Birth' =>$patients->Date_Birth,
          'Blood_Group'  => $patients -> Blood_Group,   
       'Images' => $patients->Images
    ? asset('upload_image/doctors/' . $patients->image->filename) : null
   ]);
    

}
    public function destroy(Request $request)
    {
        $patients = $this->patinetservices->destroy($request);
        return response()->json([
            'status' => true,
            'message' => 'Patients Deleted successfully.',
            'data' => $patients,
        ], 200);
    }
}
