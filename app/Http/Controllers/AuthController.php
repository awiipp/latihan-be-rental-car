<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), rules: [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid login'
            ], 401);
        }

        //attems login
        if (Auth::attempt($request->only(keys: ['username', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken(name: 'Token');

            return $token->plainTextToken;
        }
        return response()->json([
            'message' => 'invalid login'
        ], 401);
    }

    public function logout(Request $request){
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout succes'
        ]);
    }
}
