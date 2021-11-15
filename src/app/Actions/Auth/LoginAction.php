<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\LoginContract;
use App\Dtos\Auth\LoginDto;
use App\Exceptions\Auth\BadCredentials;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginAction implements LoginContract
{
    private $user;
    private $token;

    public function execute(LoginDto $dto) : JsonResponse
    {
        
        if (! $this->generateToken($dto->email, $dto->password)) {
            throw new BadCredentials('Check email or password.');
        }

        return $this->buildResponse();
    }

    private function validateCredentials($email, $password) : bool
    {
        $this->user = User::where('email', $email)->first();

        return $this->user !== null && Hash::check($password, $this->user->password);
    }

    private function generateToken($email, $password)
    {
        $this->token = false;
        if ($this->validateCredentials($email, $password)) {
            $this->token = $this->user->createToken('Token de Acceso')->plainTextToken;
        }

        return $this->token;
    }

    private function buildResponse()
    {
        return response()->json([
            'data' => [
                'token' => $this->token,
                'user' => new UserResource($this->user)
            ],
            'message' => 'User logged successfully'
        ], Response::HTTP_OK);
    }
}