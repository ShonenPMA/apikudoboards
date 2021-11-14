<?php

declare(strict_types=1);

namespace App\Dtos\Auth;

use App\Http\Requests\Auth\RegisterRequest;

class RegisterDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $birth_date,
        public string $password){ }
    
    public static function fromRequest(  RegisterRequest $request ): RegisterDto
    {
        return new RegisterDto(
            name: $request->get('name'),
            email: $request->get('email'),
            birth_date: $request->get('birth_date'),
            password: $request->get('password'),
        );
    }
}