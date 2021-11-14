<?php

declare(strict_types=1);

namespace App\Dtos\Auth;

use App\Http\Requests\Auth\EditProfileRequest;

class EditProfileDto
{
    public function __construct(
        public string $name, 
        public string $email,
        public string $birth_date,
        public string $password){ }
    
    public static function fromRequest(  EditProfileRequest $request ): EditProfileDto
    {
        return new EditProfileDto(
            name: $request->get('name'),
            email: $request->get('email'),
            birth_date: $request->get('birth_date'),
            password: $request->get('password') ?? '',
        );
    }
}