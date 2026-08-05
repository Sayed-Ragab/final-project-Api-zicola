<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use uploadImageTrait;
    public function register(RegisterRequest $request)
    {
        $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $admin->createToken('admin-token')->plainTextToken;

        $this->uploadImge(
            $request,
            'photo',
            'Admin',
            'upload_image',
            $admin->id,
            'App\Models\Admin'
        );

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
                'message' => 'Password or email incorrect',
                'data' => $admin,
            ], 200);
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

        $token = $admin->createToken('admin-token')->plainTextToken;
         return response()->json([
            'status' => true,
            'message' => 'Admin registered successfully.',
            'token' => $token,
            'role'=>'admin',
            'data' => $admin,
        ], 201);
    }

    public function update(Request $request, $id)
    {

        $input  = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $admin = Admin::findOrFail($id);
        $admin->update($input);

        if ($request->has('photo')) {

            if ($admin->image) {
                $old_img = $admin->image->filename;
                $this->Delete_attachment('upload_image', 'Admin/' . $old_img, $request->id);
            }

            $this->uploadImge($request, 'photo', 'Admin', 'upload_image', $request->id, 'App\Models\Admin');
        }


        if ($admin) {
            return response()->json([
                'status' => true,
                'data'=>$admin,
                'message' => 'Admin Updated successfully'
            ], 200);
        }
    }

    public function search(Request $request)
    {

        $query = Admin::query();
        if ($request->query('name')) {
            $query->where('name', 'LIKE', '%' . trim($request->query('name')) . '%');
        }

        $admins = $query->paginate(10);

        return response()->json([
            'status' => true,
            'data' => $admins
        ]);
    }


    public function changeStatus($id)
    {

        $admin = Admin::find($id);
        $admin->status = ($admin->status == "active") ? 'suspended' : 'active';
        $admin->save();

        return response()->json([
            'status' => true,
            'message' => 'Status toggled successfully',
            'current_status' => $admin->status
        ], 200);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin->image) {

            $this->Delete_attachment(
                'upload_image',
                'Admin/' . $admin->image->filename,
                $admin->id
            );
        }
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
        $admin = $request->user();

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
