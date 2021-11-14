<?php

declare(strict_types=1);

namespace App\Dtos\Auth;

use App\Http\Requests\Auth\LoginRequest;

class LoginDto
{
    public string $email;
    public string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    
    public static function fromRequest(  LoginRequest $request ): LoginDto
    {
        return new LoginDto(
            email: $request->get('email'),
            password: $request->get('password')
        );
    }
}