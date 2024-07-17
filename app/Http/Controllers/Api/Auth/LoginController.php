<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'     => 'required|email',
                'password'  => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $token = auth('api')->login($user);

                return response()->json([
                    'success' => true,
                    'user'    => $user,
                    'token'   => $token
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }

    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            $user->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $th->getMessage(),
            ], 500);
        }

    }
}

