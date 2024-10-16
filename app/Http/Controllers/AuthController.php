<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AuthServiceInterface;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'password');
        $result = $this->authService->register($data);

        return response()->success($result, 'User successfully registered', 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->authService->login($credentials);

        if (!$token) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->success(['token' => $token], 'Login successful');
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->success([], 'Successfully logged out');
    }

    public function me()
    {
        try {
            $user = $this->authService->getUserFromToken();
            return response()->success(compact('user'), 'User details retrieved');
        } catch (\Exception $e) {
            return response()->error($e->getMessage(), 400);
        }
    }
}
