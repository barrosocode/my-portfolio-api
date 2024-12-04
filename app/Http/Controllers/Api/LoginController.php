<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Login
    public function login(Request $request): JsonResponse
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $token = $request->user()->createToken('auth-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Sucesso',
                'token' => $token,
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email ou senha incorretos'
            ], 404);
        }
    }
}
