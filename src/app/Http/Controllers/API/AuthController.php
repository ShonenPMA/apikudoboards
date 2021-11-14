<?php

namespace App\Http\Controllers\API;

use App\Contracts\Auth\LoginContract;
use App\Contracts\Auth\LogoutContract;
use App\Contracts\Auth\RegisterContract;
use App\Dtos\Auth\LoginDto;
use App\Dtos\Auth\RegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

/**
 * @group Authentication
 */
class AuthController extends Controller
{
    /**
     * Register user
     * @responseFile responses/auth/register.json
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @param \App\Contracts\Auth\RegisterContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, RegisterContract $contract) : JsonResponse
    {
        return $contract->execute(RegisterDto::fromRequest($request));
    }

    /**
     * Login user
     * @responseFile responses/auth/login.json
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @param \App\Contracts\Auth\LoginContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, LoginContract $contract) : JsonResponse
    {
        return $contract->execute(LoginDto::fromRequest($request));
    }

    /**
     * Logout user
     * @authenticated
     * @responseFile responses/auth/logout.json
     * @param \App\Contracts\Auth\LogoutContract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutContract $contract) : JsonResponse
    {
        return $contract->execute();
    }
}
