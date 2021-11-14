<?php

declare(strict_types=1);

namespace App\Dtos\Kudo;

use App\Http\Requests\Kudo\UpdateRequest;

class UpdateDto
{
    public function __construct(public string $description){ }
    
    public static function fromRequest(  UpdateRequest $request ): UpdateDto
    {
        return new UpdateDto(
            description: $request->get('description')
        );
    }
}