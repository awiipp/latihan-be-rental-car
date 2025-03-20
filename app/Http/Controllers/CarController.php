<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::all();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'no_car' => 'required',
            'name_car' => 'required',
            'type_car' => 'required',
            'year' => 'required',
            'seat' => 'required',
            'image' => 'required',
            'total' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        $validated = $validator->validated();

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
            ], 422);
        }

        if ($request->file('image')) {
            $url = $request->file('image')->store('car', 'public');

            $validated['image'] = $url;
        }

        $data = Car::create($validated);

        return response()->json([
            'message'=>'create car success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'message' => 'car not found'
            ], 404);
        }

        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'message' => 'car not found'
            ], 404);
        }

        $validator = Validator::make($request->all(),[
            'no_car' => 'required',
            'name_car' => 'required',
            'type_car' => 'required',
            'year' => 'required',
            'seat' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'total' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'invalid field',
                'error' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        if ($request->file('image')) {
            $url = $request->file('image')->store('car', 'public');

            $validated['image'] = $url;
        } else {
            $validated['image'] = $car->image;
        }

        $data = $car->update($validated);

        return response()->json([
            'message'=>'update car success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);

        if(!$car){
            return response()->json([
                'message'=> 'car not found'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'message'=>'delete car succes',
        ]);
    }
}
