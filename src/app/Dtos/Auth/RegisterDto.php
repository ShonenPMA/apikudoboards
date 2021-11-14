<?php

declare(strict_types=1);

namespace App\Dtos\Auth;

use App\Http\Requests\Auth\RegisterRequest;

class RegisterDto
{
    public string $name;
    public string $email;
    public string $birth_date;
    public string $password;

    public function __construct(string $name, string $email, string $birth_date, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->birth_date = $birth_date;
        $this->password = $password;
    }
    
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