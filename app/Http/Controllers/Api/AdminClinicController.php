<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminClinicRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Admin_clinic;
use App\Models\Clinic_Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminClinicController extends Controller
{
    public function store(AdminClinicRequest $request)
    {

        $admin_clinic = Admin_clinic::create([
            'admin_id'  => $request->admin_id,
            'clinic_id' => $request->clinic_id,
            'status'    => $request->status,
            'note'      => $request->note,
            

        ]);
        $token = $admin_clinic->createToken('adminclinic-token')->plainTextToken;
        if ($admin_clinic) {
            return response()->json([
                'status' => true,
                'message' => 'admin_clinic Create successfully.',
                'data' => $admin_clinic,
                'token' => $token,
                'role' => 'admin_clinic',
            ], 201);
        }
    }
   
    public function login(LoginRequest $request)
    {
        $adminclinic = Admin_clinic::where('email', $request->email)->first();

        if (!$adminclinic) {
            return response()->json([
                'status' => false,
                'message' => 'Password or email incorrect',

            ], 200);
        }

        if ($adminclinic->status == 'suspended') {
            return response()->json([
                'status' => false,
                'message' => 'This email suspended'
            ], 403);
        }

        if (!Hash::check($request->password, $adminclinic->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password or email incorrect'
            ], 401);
        }

        $token = $adminclinic->createToken('admin-clinic-token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'AdminClinic registered successfully.',
            'token' => $token,
            'data' => $adminclinic,
        ], 201);
    }
    public function update(Request $request, string $id)
    {

        $update = Admin_clinic::findOrFail($id);
        $update->update([
                 'admin_id'  => $request->admin_id,
            'clinic_id' => $request->clinic_id,
            'status'    => $request->status,
            'note'      => $request->note,
            
        ]);
        if ($update) {
            return response()->json([
                'status' => true,
                'message' => 'admin_clinic updated successfully.',
                'data' => $update,
            ], 201);
        }
    }
    public function destroy(Request $request, string $id)
    {
        $admin_clinic = Admin_clinic::findOrFail($id);
        $admin_clinic->delete();

        if ($admin_clinic) {
            return response()->json([
                'status' => true,
                'message' => 'admin_clinic deleted successfully.',
                'data' => $admin_clinic,
            ], 201);
        }
    }

    public function GetAdminClinic(){
  $admin_clinic =  Admin_clinic::with('admin','clinic','Patients')->paginate(10);
  if ($admin_clinic) {
            return response()->json([
                'status' => true,
                'message' => 'admin_clinic geeting successfully.',
                'data' => $admin_clinic,
            ], 201);
        }

}
}
