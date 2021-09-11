<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Library\ApiHelpers;

class LoginController extends Controller
{
    use ApiHelpers;
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            $user = User::where('email',$request->email)->with('role')->first();
            if (!$user) {
                return $this->onError('Email tidak ditemukan', 404);
            }else if(!$user || !Hash::check($request->password, $user->password)){
                return $this->onError('Password yang Anda Masukkan Salah', 404);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' =>'Bearer',
                'user' => $user,
            ],200);

        } catch (QueryException $error) {
            return response()->json([
                'status_code'  => 500,
                'message' => 'Error in Login',
                'error' => $error
            ]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status_code' => 200,
            'success' => 'Logout Success',
        ],200);
    }
}
