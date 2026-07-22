<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
         $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $admin->createToken('admin-token')->plainTextToken;

          return response()->json([
            'status' => true,
            'message' => 'Admin registered successfully.',
            'token' => $token,
            'data' => $admin,
        ], 201);
    }


    public function login(LoginRequest $request)
{
  $admin = Admin::where('email', $request->email)->first();

if (!$admin) {
    return response()->json([
        'status' => false,
        'message' => 'Password or email incorrect'
    ], 401);
}

if ($admin->status == 'suspended') {
    return response()->json([
        'status' => false,
        'message' => 'This email suspended'
    ], 403);
}

if (!Hash::check($request->password, $admin->password)) {
    return response()->json([
        'status' => false,
        'message' => 'Password or email incorrect'
    ], 401);
}
}

public function update(Request $request ,$id){
   
    $input  = $request->all();
    if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);

    }else{
         $input = Arr::except($input, ['password']);
    }

    $admin = Admin::find($id);
    $admin->update($input);
    if($admin){
    return response()->json([
        'status' => true,
        'message' => 'Admin Updated successfully'
    ], 200);
}


}

public function Search_Admin(Request $request){
    $query = Admin::Query();
    if($request->filled('search')){
        $query->where('name','like','%'.$request->search.'%');
    }
     $admins = $query->get();

     return response()->json([
        'status' => true,
        'data' => $admins
    ]);


}


public function changeStatus($id){
    
  $admin = Admin::find($id);
  $admin->status = ($admin->status == "active") ? 'suspended':'active';
  $admin->save();

  return response()->json([
        'status' => true,
        'message' => 'Status toggled successfully',
        'current_status' => $admin->status 
    ], 200);
}

public function destroy($id){
$admin = Admin::find($id);
if (!$admin) {
        return response()->json([
            'status' => false,
            'message' => 'Admin not found'
        ], 404); 
    }
    $admin->delete();

    return response()->json([
        'status' => true,
        'message' => 'Admin deleted successfully'
    ], 200);
}

public function logout(Request $request)
{
   $admin = $request->user('admin');

    if ($admin) {
        $admin->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully.'
        ]);
    }
    return response()->json([
        'status' => false,
        'message' => 'User not authenticated.'
    ], 401);
}
}
