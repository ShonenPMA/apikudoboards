<?php

namespace App\Http\Controllers\API;

use App\Contracts\Auth\RegisterContract;
use App\Dtos\Auth\RegisterDto;
use App\Http\Controllers\Controller;
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
}
