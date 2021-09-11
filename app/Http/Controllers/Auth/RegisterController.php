<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function isemailexist(Request $request){
        $email = User::findEmail($request->email);
        if ($email) {
            return response()->json([
                'message' => 'User Exist Already',
                'data' => $email
            ],409);
        }else{
            return response()->json([
                'message' => 'User is not exist',
            ],200);
        }
    }
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => ['required','email'],
            'name' => ['required'],
            'password' =>['required','string'],
            'role' => ['required','in:admin,mentor,mentee']
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $userExist = User::findEmail($request->email);
        if ($userExist) {
            return response()->json([
                'message' => 'email telah digunakan ',
                'data' => $userExist
            ],409);
        }
        
        try {
            $user = User::create([
                'name' =>$request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $response = [
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' =>'Bearer',
                'user' => $user

            ];

            return response()->json($response,Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed ' . $e->ErrorInfo
            ]);
        }
    }
}
