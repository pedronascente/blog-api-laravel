<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Resources\Api\V1\UserResource;

class AuthController extends Controller
{
    // Registro
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ], 201);
    }

    // Login
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar token'], 500);
        }

        $user = auth()->user();

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    // Retornar usuário logado
    public function user()
    {
        return new UserResource(auth()->user());
    }
}
