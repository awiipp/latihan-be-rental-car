<?php

namespace App\Http\Controllers;

use App\Models\Penalties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenaltiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Penalties::with(['car'])->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penalties_name' => 'required',
            'description' => 'required',
            'id_car' => 'required|exists:cars,id',
            'penalties_total' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = Penalties::create($validator->validated());

        return response()->json([
            'message'=>'create penalties success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $penalties = Penalties::with(['car'])->where('id', $id)->find($id);
        $penalties = Penalties::find($id);

        if (!$penalties) {
            return response()->json([
                'message' => 'penalties not found'
            ], 404);
        }


        return response()->json($penalties);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penalties = Penalties::find($id);

        if (!$penalties) {
            return response()->json([
                'message' => 'penalties not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'penalties_name' => 'required',
            'description' => 'required',
            'id_car' => 'required|exists:cars,id',
            'penalties_total' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = $penalties->update($validator->validated());

        return response()->json([
            'message'=>'update penalties success',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penalties = Penalties::find($id);

        if(!$penalties){
            return response()->json([
                'message'=> 'penalties not found'
            ], 404);
        }

        $penalties->delete();

        return response()->json([
            'message'=>'delete penalties succes',
        ]);
    }
}
