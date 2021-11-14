<?php

declare(strict_types=1);

namespace App\Dtos\Auth;

use App\Http\Requests\Auth\LoginRequest;

class LoginDto
{
    public function __construct(
        public string $email,
        public string $password){ }
    
    public static function fromRequest(  LoginRequest $request ): LoginDto
    {
        return new LoginDto(
            email: $request->get('email'),
            password: $request->get('password')
        );
    }
}