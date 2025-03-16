<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
        // Login and issue token
        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales Invalidad'], 401);
            }
    
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
    
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        }
    
        // Logout and revoke token
        public function logout(Request $request)
        {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Ingreso Exitoso']);
        }
}
