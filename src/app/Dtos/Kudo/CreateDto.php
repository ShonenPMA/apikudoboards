<?php

declare(strict_types=1);

namespace App\Dtos\Kudo;

use App\Http\Requests\Kudo\CreateRequest;

class CreateDto
{
    public function __construct(public string $description, public int $kudoboard_id, public int $user_receiver_id ){ }
    
    public static function fromRequest(  CreateRequest $request ): CreateDto
    {
        return new CreateDto(
            description: $request->get('description'),
            kudoboard_id: $request->get('kudoboard_id'),
            user_receiver_id: $request->get('user_receiver_id'),
        );
    }
}