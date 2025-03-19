<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Rent::all();

        // eager
        $data = Rent::with(['car', 'register'])->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_tenant' => 'required|exists:registers,id',
            'id_car' => 'required|exists:cars,id',
            'date_borrow' => 'required',
            'date_return' => 'required',
            'down_payment' => 'required',
            'discount' => 'required',
            'total' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = Rent::create($validator->validated());

        return response()->json([
            'message'=>'create rent success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rent = Rent::find($id);

        if (!$rent) {
            return response()->json([
                'message' => 'rent not found'
            ], 404);
        }

        return response()->json($rent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rent = Rent::find($id);

        $validator = Validator::make($request->all(),[
            'id_tenant' => 'required|exists:registers,id',
            'id_car' => 'required|exists:cars,id',
            'date_borrow' => 'required',
            'date_return' => 'required',
            'down_payment' => 'required',
            'discount' => 'required',
            'total' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = $rent->update($validator->validated());

        return response()->json([
            'message'=>'update rent success',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rent = Rent::find($id);

        if(!$rent){
            return response()->json([
                'message'=> 'rent not found'
            ], 404);
        }

        $rent->delete();

        return response()->json([
            'message'=>'delete rent succes',
        ]);
    }
}
