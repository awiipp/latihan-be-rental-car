<?php

namespace App\Http\Controllers;

use App\Models\CarReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CarReturn::with('register', 'car', 'penalties')->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tenant' => 'required|exists:registers,id',
            'id_car' => 'required|exists:cars,id',
            'id_penalties' => 'required|exists:penalties,id',
            'date_borrow' => 'required',
            'date_return' => 'required',
            'discount' => 'required',
            'penalties_total' => 'required',
            'total' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = CarReturn::create($validator->validated());

        return response()->json([
            'message'=>'create car return success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carReturn = CarReturn::find($id);

        if (!$carReturn) {
            return response()->json([
                'message' => 'car return not found'
            ], 404);
        }

        $data = CarReturn::with(['register', 'car', 'penalties'])->where('id', $carReturn->id)->get();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $carReturn = CarReturn::find(($id));

        if (!$carReturn) {
            return response()->json([
                'message' => 'car return not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_tenant' => 'required|exists:registers,id',
            'id_car' => 'required|exists:cars,id',
            'id_penalties' => 'required|exists:penalties,id',
            'date_borrow' => 'required',
            'date_return' => 'required',
            'discount' => 'required',
            'penalties_total' => 'required',
            'total' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = CarReturn::create($validator->validated());

        return response()->json([
            'message'=>'create car return success',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carReturn = CarReturn::find($id);

        if(!$carReturn){
            return response()->json([
                'message'=> 'car Return not found'
            ], 404);
        }

        $carReturn->delete();

        return response()->json([
            'message'=>'delete car Return succes',
        ]);
    }
}
