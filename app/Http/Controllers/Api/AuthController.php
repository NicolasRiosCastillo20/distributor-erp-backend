<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $authService
    ) {}
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request->validated());

        return response()->json([
            'message' => $data['message'],
            'user' => $data['user'],
            'token' => $data['token'],
        ], 201);
    }


    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated());

        return response()->json([
            'message' => $data['message'],
            'user' => $data['user'],
            'token' => $data['token'],
        ], 200);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'User logged out successfully',
        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
