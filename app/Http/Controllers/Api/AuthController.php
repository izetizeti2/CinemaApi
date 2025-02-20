<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect'
            ], 401);
        }
    
        // Krijimi i token-it
        $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;
    
        // Kthejmë të dhënat e login-it dhe token-in
        return response()->json([
            'message' => 'Login Successful',
            'role' => $user->role,
            'token_type' => 'Bearer',
            'token' => $token
        ], 200);
    }

        public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Sigurojmë që çdo regjistrim ka 'user' si rol
        ]);

        if ($user) {
            $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;

            return response()->json([
                'message' => 'Registration Successful',
                'role' => $user->role,
                'token_type' => 'Bearer',
                'token' => $token
            ], 201);
        } else {
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);
        }
    }


    public function logout(Request $request){
        $user = User::where('id',$request->user()->id)->first();
        if($user){
            $user->tokens()->delete();
            return response()->json([
                'message'=>'Logged out Successful',
            ], 200);
        }
        else {
            return response()->json([
                'message'=>'Not found',
            ], 404);
        }

    }

   

}
