<?php

namespace App\Actions\Auth;

use App\Contracts\Auth\RegisterContract;
use App\Dtos\Auth\RegisterDto;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterAction implements RegisterContract
{
    private $user;
    private $token;
    public function execute(RegisterDto $dto) : JsonResponse
    {
        
        return  $this->registerUser($dto)
                        ->generateToken()
                        ->buildResponse();
    }

    private function registerUser(RegisterDto $dto)
    {
        $this->user = new User();
        $this->user->name = $dto->name;
        $this->user->email = $dto->email;
        $this->user->birth_date = $dto->birth_date;
        $this->user->password = bcrypt($dto->password);
        $this->user->save();

        return $this;
    }

    private function generateToken()
    {
        $this->token = $this->user
            ->createToken('Token de Acceso')
            ->plainTextToken;

        return $this;
    }

    private function buildResponse()
    {
        return response()->json([
            'data' => [
                'token' => $this->token
            ],
            'message' => 'User created successfully'
        ], Response::HTTP_OK);
    }
}