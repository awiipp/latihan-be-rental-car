<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Register::all();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'no_ktp' => 'required',
            'name' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = Register::create($validator->validated());

        return response()->json([
            'message'=>'create register success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $register = Register::find($id);

        if (!$register) {
            return response()->json([
                'message' => 'register not found'
            ], 404);
        }

        return response()->json($register);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $register = Register::find($id);

        if(!$register){
            return response()->json([
                'message'=> 'register not found'
            ], 404);
        }

        $validator = Validator::make($request->all(),[
            'no_ktp' => 'required',
            'name' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        $data = $register->update($validator->validated());

        return response()->json([
            'message'=>'update register success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $register = Register::find($id);

        if(!$register){
            return response()->json([
                'message'=> 'register not found'
            ], 404);
        }

        $register->delete();

        return response()->json([
            'message'=>'delete register succes',
        ]);
    }
}
