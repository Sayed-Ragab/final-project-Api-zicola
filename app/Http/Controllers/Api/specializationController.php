<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;

class specializationController extends Controller
{

    public function index()
    {
        $specializations = Specialization::paginate(10);

        return response()->json([
            'status' => true,
            'data' => $specializations,
        ]);
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
    public function store(StoreSpecializationRequest $request)
    {
        $specializations = Specialization::create([
            'name' => $request->name,
            'note' => $request->note,
        ]);
        if ($specializations) {
            return response()->json([
                'status' => true,
                'message' => 'specializations  created  successfully.',
                'data' => $specializations,
            ], 201);
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

        $specializations = Specialization::findOrFail($id);
        $specializations->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);
        if ($specializations) {
            return response()->json([
                'status' => true,
                'message' => 'specializations update successfully.',
                'data' => $specializations,
            ], 201);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specializations = Specialization::findorfail($id);
        $specializations->delete();
        if ($specializations) {
            return response()->json([
                'status' => true,
                'message' => 'specializations  Deleted  successfully.',
                'data' => $specializations,
            ], 201);
        }
    }
}
