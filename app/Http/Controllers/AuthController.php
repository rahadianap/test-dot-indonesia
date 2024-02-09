<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $body = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $body['name'],
            'email' => $body['email'],
            'password' => bcrypt($body['password'])
        ]);

        $token = $user->createToken('api_token');

        return response()->json([
            'success' => true,
            'token' => $token->plainTextToken
        ], 201);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('AuthToken')->plainTextToken; 
            $success['name'] =  $authUser->name;
    
            return response()->json([
                'success' => true,
                'token' => $success['token']
            ], 200);
        } 
        else{ 
            return response()->json([
                'success' => false,
                'error-code' => 401,
                'errors' => 'Unauthorized',
                'message' => 'Wrong email or password'
            ], 401);
        } 
    }
}
