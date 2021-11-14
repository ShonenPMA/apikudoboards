<?php

declare(strict_types=1);

namespace App\Dtos\Team;

use App\Http\Requests\Team\UpdateRequest;

class UpdateDto
{
    public function __construct(public string $name){ }
    
    public static function fromRequest(  UpdateRequest $request ): UpdateDto
    {
        return new UpdateDto(
            name: $request->get('name')
        );
    }
}